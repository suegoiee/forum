<nav class="navbar navbar-inverse navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Laravel.io</a>
        </div>

        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ active(['forum', 'threads*', 'thread']) }}"><a href="{{ route('forum') }}">Forum</a></li>
                <!--li><a href="https://paste.laravel.io">Pastebin</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chat <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://discord.gg/KxwQuKb">Discord</a></li>
                        <li><a href="https://larachat.co/">Larachat</a></li>
                        <li><a href="https://webchat.freenode.net/?nick=laravelnewbie&channels=%23laravel&prompt=1">IRC</a></li>
                    </ul>
                </li>
                <li><a href="https://laravelevents.com">Events</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Community <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://github.com/laravelio"><i class="fa fa-github"></i> Github</a></li>
                        <li><a href="https://twitter.com/laravelio"><i class="fa fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://medium.com/laravelio"><i class="fa fa-medium"></i> Medium</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="https://laravel.com">Laravel</a></li>
                        <li><a href="https://laracasts.com">Laracasts</a></li>
                        <li><a href="https://laravel-news.com">Laravel News</a></li>
                        <li><a href="http://www.laravelpodcast.com">Podcast</a></li>
                    </ul>
                </li-->
                
                <style>
                    .dropdownlist {
                        position: relative;
                        display: inline-block;
                        width: 100%;
                    }

                    .dropdown-content {
                        left: 158px;
                        top: 0px;
                    }
                    
                    .dropdownlist:hover .dropdown-content {
                        display: block;
                    }
                    .fas {
                        position: relative;
                        margin-top: 3px;
                        float: right;
                    }
                </style>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">股票資訊<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('freebie.stockbasicinfo.stocksummary') }}">個股摘要</a></li>
                        <li class="dropdownlist">
                            <a>月營收<i class='fas fa-angle-right'></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('freebie.MonthlyRevenue') }}">每月營收變化表</a></li>
                                <li><a href="{{ route('freebie.MonthlyRevenueVSStockPrice') }}">月營收與股價對照表</a></li>
                                <li><a href="{{ route('freebie.MonthlyRevenueGrowthRate') }}">月營收成長率</a></li>
                                <li><a href="{{ route('freebie.ShortTermRevenueVSLongTermRevenue') }}">長短期營收趨勢圖</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a>財務報表<i class='fas fa-angle-right'></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('freebie.IncomeStatement') }}">損益表</a></li>
                                <li><a href="{{ route('freebie.StatementOfFinancialPosition') }}">資產負債表</a></li>
                                <li><a href="{{ route('freebie.CashFlows') }}">現金流量表</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a>股息政策<i class='fas fa-angle-right'></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('freebie.HistoricalDividendRecord') }}">歷年股息表</a></li>
                                <li><a href="{{ route('freebie.CashDividendPayoutRatio') }}">股息配發率</a></li>
                                <li><a href="{{ route('freebie.StockPriceVSYield') }}">股價 vs 殖利率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a>籌碼資訊<i class='fas fa-angle-right'></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('freebie.InstitutionalInvestorsNet') }}">三大法人買賣超日報表</a></li>
                                <li><a href="{{ route('freebie.QFIIHoldingsVSStockPrice') }}">外資持股比率</a></li>
                                <li><a href="{{ route('freebie.BoardHoldingsVSStockPrice') }}">董監持股比率</a></li>
                                <li><a href="{{ route('freebie.ShortInterestAsOfMarginPurchase') }}">券資比</a></li>
                                <li><a href="{{ route('freebie.MarginPurchaseIncrease') }}">融資增減變化</a></li>
                                <li><a href="{{ route('freebie.MarginBalanceVSMarginUtilization') }}">融資餘額與融資使用率</a></li>
                                <li><a href="{{ route('freebie.ShortInterestIncrease') }}">融券增減變化</a></li>
                                <li><a href="{{ route('freebie.ShortInterestVSShortSellUtilization') }}">融券餘額與融券使用率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a>股票評價<i class='fas fa-angle-right'></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('freebie.HistoricalPer') }}">本益比評價</a></li>
                                <li><a href="{{ route('freebie.HistoricalPbr') }}">股價淨值比評價</a></li>
                                <li><a href="">股息殖利率評價</a></li>
                            </ul>
                        </li>
                        <!--li role="separator" class="divider"></li-->
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ active('login') }}"><a href="{{ route('login') }}">Login</a></li>
                    <li class="{{ active('register') }}"><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="img-circle" src="{{ Auth::user()->gravatarUrl(60) }}" width="30"> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <span>
                                    <strong>{{ Auth::user()->name() }}</strong><br>
                                    {{ '@'.Auth::user()->username() }}
                                </span>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li class="{{ active('profile') }}"><a href="{{ route('profile', Auth::user()->username()) }}"><i class="fa fa-user-circle-o dropdown-icon" aria-hidden="true"></i>Profile</a></li>
                            <li class="{{ active('dashboard') }}"><a href="{{ route('dashboard') }}"><i class="fa fa-home dropdown-icon" aria-hidden="true"></i>Dashboard</a></li>
                            <li class="{{ active('settings.*') }}"><a href="{{ route('settings.profile') }}"> <i class="fa fa-cog dropdown-icon" aria-hidden="true"></i>Settings</a></li>

                            @can(App\Policies\UserPolicy::ADMIN, App\User::class)
                                <li role="separator" class="divider"></li>
                                <li class="{{ active('admin*') }}"><a href="{{ route('admin') }}"><i class="fa fa-shield dropdown-icon" aria-hidden="true"></i>Admin</a></li>
                            @endcan

                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out dropdown-icon" aria-hidden="true"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
