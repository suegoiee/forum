<nav class="navbar navber-bd navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"></a>
        </div>

        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ active(['forum', 'threads*', 'thread']) }}">
                    <a class="nav-font chatt" href="{{ route('forum') }}">
                        <div class="chatWord">討論區</div>
                    </a>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-font stock down" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="stockWord" style="display:inline-block; padding-right:5px;">股票資訊</div><span id="triangle-down"></span></a>
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
                    <a href="#" class="dropdown-toggle nav-font down tool" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="toolWord" style="display:inline-block; padding-right:5px;">小工具</div><span id="triangle-down"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdownlist">
                            <a class="menu">計算股票價值<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.buffett') }}">巴菲特預估股價</a></li>
                                <li><a href="{{ route('Tools.deposit') }}">定存股價值試算表</a></li>
                                <li><a href="{{ route('Tools.proportion') }}">本益成長比</a></li>
                                <li><a href="{{ route('Tools.gordon') }}">高登模型</a></li>
                                <li><a href="{{ route('Tools.secondDCF') }}">兩階段 現金流折現模型 DCF</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">買賣股票試算<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.money') }}">除權息參考價</a></li>
                                <li><a href="{{ route('Tools.bargain') }}">損益試算</a></li>
                                <li><a href="{{ route('Tools.DepositInGroup') }}">揪團買股</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">投資檢查表<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.buyCheckForm') }}">股票買進檢查表</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">營收盈餘預估<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.Compound') }}">年複合成長率</a></li>
                                <li><a href="{{ route('Tools.estimate') }}">市占率預估</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">投資屬性測驗<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.DepositTest') }}">存股性向測驗</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">資本規劃試算<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.npv') }}">NPV計算機</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu">理財小工具<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.interest') }}">複利計算</a></li>
                                <li><a href="{{ route('Tools.PayBack') }}">貸款試算</a></li>
                                <li><a href="{{ route('Tools.retire') }}">退休規劃</a></li>
                                <li><a href="{{ route('Tools.lowestRetire') }}">最低退休金</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="https://pro.uanalyze.com.tw" class="nav-font pro" target="_blank"><div class="proWord">優分析Pro</div></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ active('login') }}"><a class="login log" href="{{ route('login') }}"><div class="logWord">登入</div></a></li>
                    <li class="{{ active('register') }}"><a class="login reg" href="{{ route('register') }}"><div class="regWord">註冊</div></a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/images/icon/userLogin.svg" style="width:30px; padding-top:20%;"> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <span>
                                    <strong>{{ Auth::user()->name() }}</strong><br>
                                    {{ '@'.Auth::user()->username() }}
                                </span>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li class="{{ active('settings.*') }}"><a href="{{ route('dashboard') }}"> <i class="fa fa-tag dropdown-icon" aria-hidden="true"></i>我的文章</a></li>
                            <li class="{{ active('settings.*') }}"><a href="{{ route('settings.profile') }}"> <i class="fa fa-cog dropdown-icon" aria-hidden="true"></i>設定</a></li>

                            @can(App\Policies\UserPolicy::ADMIN, App\User::class)
                                <li role="separator" class="divider"></li>
                                <li class="{{ active('admin*') }}"><a href="{{ route('admin') }}"><i class="fa fa-shield dropdown-icon" aria-hidden="true"></i>Admin</a></li>
                            @endcan

                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out dropdown-icon" aria-hidden="true"></i>登出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


