<?php

namespace App\Models;

use DB;
use App\Helpers\HasSlug;
use App\Helpers\HasTags;
use App\Helpers\HasAuthor;
use App\Helpers\ModelHelpers;
use App\Helpers\HasTimestamps;
use App\Helpers\ReceivesReplies;
use App\Helpers\ProvidesSubscriptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use App\Exceptions\CouldNotMarkReplyAsSolution;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Archive extends Model implements ReplyAble, SubscriptionAble
{
    use HasAuthor, HasSlug, HasTimestamps, ModelHelpers, ProvidesSubscriptions, ReceivesReplies, HasTags;

    const TABLE = 'archives';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'body',
        'slug',
        'subject',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function subject(): string
    {
        return $this->subject;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function excerpt(int $limit = 100): string
    {
        return str_limit(strip_tags(md_to_html($this->body())), $limit);
    }

    public function solutionReply(): ?Reply
    {
        return $this->solutionReplyRelation;
    }

    public function solutionReplyRelation(): BelongsTo
    {
        return $this->belongsTo(Reply::class, 'solution_reply_id');
    }

    public function isSolutionReply(Reply $reply): bool
    {
        if ($solution = $this->solutionReply()) {
            return $solution->matches($reply);
        }

        return false;
    }

    public function markSolution(Reply $reply)
    {
        $archive = $reply->replyAble();

        if (! $archive instanceof self) {
            throw CouldNotMarkReplyAsSolution::replyAbleIsNotAThread($reply);
        }

        $this->solutionReplyRelation()->associate($reply);
        $this->save();
    }

    public function unmarkSolution()
    {
        $this->solutionReplyRelation()->dissociate();
        $this->save();
    }

    public function delete()
    {
        $this->removeTags();
        $this->deleteReplies();

        parent::delete();
    }

    /**
     * @return \App\Models\Thread[]
     */
    public static function feed(int $limit = 20): Collection
    {
        return static::feedQuery()->limit($limit)->get();
    }

    /**
     * @return \App\Models\Thread[]
     */
    public static function feedPaginated(int $perPage = 20): Paginator
    {
        return static::feedQuery()->paginate($perPage);
    }

    /**
     * @return \App\Models\Thread[]
     */
    public static function feedByTagPaginated(Tag $tag, int $perPage = 20): Paginator
    {
        return static::feedQuery()
            ->join('taggables', function ($join) use ($tag) {
                $join->on('archives.id', 'taggables.taggable_id')
                    ->where('taggable_type', static::TABLE);
            })
            ->where('taggables.tag_id', $tag->id())
            ->paginate($perPage);
    }

    /**
     * This will order the archives by creation date and latest reply.
     */
    public static function feedQuery(): Builder
    {
        return static::leftJoin('replies', function ($join) {
            $join->on('archives.id', 'replies.replyable_id')
                    ->where('replies.replyable_type', static::TABLE);
        })
            ->orderBy('latest_creation', 'DESC')
            ->groupBy('archives.id')
            ->select('archives.*', DB::raw('
                CASE WHEN COALESCE(MAX(replies.created_at), 0) > archives.created_at
                THEN COALESCE(MAX(replies.created_at), 0)
                ELSE archives.created_at
                END AS latest_creation
            '));
    }
}
