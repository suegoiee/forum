<nav class="navbar navber-bd navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">U分析</a>
        </div>

        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="https://pro.uanalyze.com.tw" class="nav-font" target="_blank"><img src="/images/logo_light.svg" width="30px">優分析</a></li>
                <li class="{{ active(['forum', 'threads*', 'thread']) }}"><a class="chat nav-font" href="{{ route('forum') }}">討論區</a></li>
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
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-font" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">股票資訊<i class="fas fa-sort-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="menu" href="{{ route('freebie.stockbasicinfo.stocksummary') }}">個股摘要</a></li>
                        <li><a class="menu" href="{{ route('freebie.StockNews') }}">個股新聞</a></li>
                        <li><a class="menu" href="{{ route('freebie.DailyStockPriceAreaChartWithDisplay') }}">股價走勢</a></li>
                        <li><a class="menu" href="{{ route('freebie.StockPriceVSEPS') }}">每股盈餘VS股價</a></li>
                        <li class="dropdownlist">
                            <a class="menu">月營收<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.MonthlyRevenue') }}">每月營收變化表</a></li>
                                <li><a class="menu" href="{{ route('freebie.MonthlyRevenueVSStockPrice') }}">月營收與股價對照表</a></li>
                                <li><a class="menu" href="{{ route('freebie.MonthlyRevenueGrowthRate') }}">月營收成長率</a></li>
                                <li><a class="menu" href="{{ route('freebie.ShortTermRevenueVSLongTermRevenue') }}">長短期營收趨勢圖</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">財務報表<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.IncomeStatement') }}">損益表</a></li>
                                <li><a class="menu" href="{{ route('freebie.StatementOfFinancialPosition') }}">資產負債表</a></li>
                                <li><a class="menu" href="{{ route('freebie.CashFlows') }}">現金流量表</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">股息政策<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.HistoricalDividendRecord') }}">歷年股息表</a></li>
                                <li><a class="menu" href="{{ route('freebie.CashDividendPayoutRatio') }}">股息配發率</a></li>
                                <li><a class="menu" href="{{ route('freebie.StockPriceVSYield') }}">股價 vs 殖利率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">籌碼資訊<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.InstitutionalInvestorsNet') }}">三大法人買賣超日報表</a></li>
                                <li><a class="menu" href="{{ route('freebie.QFIIHoldingsVSStockPrice') }}">外資持股比率</a></li>
                                <li><a class="menu" href="{{ route('freebie.BoardHoldingsVSStockPrice') }}">董監持股比率</a></li>
                                <li><a class="menu" href="{{ route('freebie.ShortInterestAsOfMarginPurchase') }}">券資比</a></li>
                                <li><a class="menu" href="{{ route('freebie.MarginPurchaseIncrease') }}">融資增減變化</a></li>
                                <li><a class="menu" href="{{ route('freebie.MarginBalanceVSMarginUtilization') }}">融資餘額與融資使用率</a></li>
                                <li><a class="menu" href="{{ route('freebie.ShortInterestIncrease') }}">融券增減變化</a></li>
                                <li><a class="menu" href="{{ route('freebie.ShortInterestVSShortSellUtilization') }}">融券餘額與融券使用率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">股票評價<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.HistoricalPer') }}">本益比評價</a></li>
                                <li><a class="menu" href="{{ route('freebie.HistoricalPbr') }}">股價淨值比評價</a></li>
                                <li><a class="menu" href="">股息殖利率評價</a></li>
                            </ul>
                        </li>
                        <!--li role="separator" class="divider"></li-->
                    </ul>
                </li>

                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-font" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">小工具<i class="fas fa-sort-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('Tools.bargain') }}">買賣股票損益</a></li>
                        <li><a href="{{ route('Tools.buffett') }}">巴菲特預估股價</a></li>
                        <li><a href="{{ route('Tools.buyCheckForm') }}">股票買進檢查表</a></li>
                        <li><a href="{{ route('Tools.Compound') }}">年複合成長率</a></li>
                        <li><a href="{{ route('Tools.deposit') }}">定存股價值試算表</a></li>
                        <li><a href="{{ route('Tools.estimate') }}">市占率預估</a></li>
                        <li><a href="{{ route('Tools.gordon') }}">高登模型</a></li>
                        <li><a href="{{ route('Tools.interest') }}">複利計算</a></li>
                        <li><a href="{{ route('Tools.lowestRetire') }}">最低退休金</a></li>
                        <li><a href="{{ route('Tools.money') }}">除權息參考價</a></li>
                        <li><a href="{{ route('Tools.npv') }}">NPV計算機</a></li>
                        <li><a href="{{ route('Tools.proportion') }}">本益成長比</a></li>
                        <li><a href="{{ route('Tools.retire') }}">退休規劃</a></li>
                        <li><a href="{{ route('Tools.PayBack') }}">貸款試算</a></li>
                        <li><a href="{{ route('Tools.secondDCF') }}">兩階段 現金流折現模型 DCF</a></li>
                        <li><a href="{{ route('Tools.DepositTest') }}">存股性向測驗</a></li>
                        <li><a href="{{ route('Tools.DepositInGroup') }}">揪團買股</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ active('login') }}"><a class="login" href="{{ route('login') }}">登入</a></li>
                    <li class="{{ active('register') }}"><a class="login" href="{{ route('register') }}">註冊</a></li>
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


