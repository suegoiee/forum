<nav class="navbar navber-bd navbar-default navbar-static-top">
    <div class="container widthNav" style="padding-left: 0px; padding-right: 0px;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="home page"></a>
        </div>

        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="nav navbar-nav">
                @php
                    if(isset($_COOKIE['stockCode'])){
                        $StockCode = $_COOKIE['stockCode'];
                    }
                    else{
                        $StockCode = '1101';
                        setcookie("stockCode", '1101', time()+172800, env('APP_URL'), env('APP_URL'), 1);
                    }
                @endphp
                <li class="dropdown {{ active('freebie*') }}">
                    <a href="#" class="dropdown-toggle nav-font down" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-bar"></i>  股票資訊  <span class="triangle-down"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="menu" href="{{ route('freebie.stockbasicinfo.stocksummary', ['StockCode' => $StockCode, 'InfoCh' => '個股摘要']) }}">個股摘要</a></li>

                        <li class="dropdownlist">
                            <a class="menu" href="#">月營收<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.Table', ['InfoType' => 'MonthlyRevenue_sorting_table', 'StockCode' => $StockCode, 'InfoCh' => '每月營收變化表']) }}">每月營收變化表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'MonthlyRevenueVSStockPrice', 'StockCode' => $StockCode, 'InfoCh' => '月營收與股價對照表']) }}">月營收與股價對照表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'MonthlyRevenueGrowthRate', 'StockCode' => $StockCode, 'InfoCh' => '月營收成長率']) }}">月營收成長率</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'ShortTermRevenueVSLongTermRevenue', 'StockCode' => $StockCode, 'InfoCh' => '長短期營收趨勢圖']) }}">長短期營收趨勢圖</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">財務報表<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.Report', ['InfoType' => 'IncomeStatement', 'StockCode' => $StockCode, 'InfoCh' => '損益表']) }}">損益表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Report', ['InfoType' => 'StatementOfFinancialPosition', 'StockCode' => $StockCode, 'InfoCh' => '資產負債表']) }}">資產負債表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Report', ['InfoType' => 'CashFlows', 'StockCode' => $StockCode, 'InfoCh' => '現金流量表']) }}">現金流量表</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">股息政策<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.Table', ['InfoType' => 'HistoricalDividendRecord', 'StockCode' => $StockCode, 'InfoCh' => '歷年股息表']) }}">歷年股息表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'CashDividendPayoutRatio', 'StockCode' => $StockCode, 'InfoCh' => '股息配發率']) }}">股息配發率</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'StockPriceVSYield', 'StockCode' => $StockCode, 'InfoCh' => '股價 vs 殖利率']) }}">股價 vs 殖利率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">籌碼資訊<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.Table', ['InfoType' => 'InstitutionalInvestorsNet', 'StockCode' => $StockCode, 'InfoCh' => '三大法人買賣超日報表']) }}">三大法人買賣超日報表</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'QFIIHoldingsVSStockPrice', 'StockCode' => $StockCode, 'InfoCh' => '外資持股比率']) }}">外資持股比率</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'BoardHoldingsVSStockPrice', 'StockCode' => $StockCode, 'InfoCh' => '董監持股比率']) }}">董監持股比率</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'ShortInterestAsOfMarginPurchase', 'StockCode' => $StockCode, 'InfoCh' => '券資比']) }}">券資比</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'MarginPurchaseIncrease', 'StockCode' => $StockCode, 'InfoCh' => '融資增減變化']) }}">融資增減變化</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'MarginBalanceVSMarginUtilization', 'StockCode' => $StockCode, 'InfoCh' => '融資餘額與融資使用率']) }}">融資餘額與融資使用率</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'ShortInterestIncrease', 'StockCode' => $StockCode, 'InfoCh' => '融券增減變化']) }}">融券增減變化</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'ShortInterestVSShortSellUtilization', 'StockCode' => $StockCode, 'InfoCh' => '融券餘額與融券使用率']) }}">融券餘額與融券使用率</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">股票評價<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'HistoricalPer', 'StockCode' => $StockCode, 'InfoCh' => '本益比評價']) }}">本益比評價</a></li>
                                <li><a class="menu" href="{{ route('freebie.Chart', ['InfoType' => 'HistoricalPbr', 'StockCode' => $StockCode, 'InfoCh' => '股價淨值比評價']) }}">股價淨值比評價</a></li>
                                <!--li><a class="menu" href="">股息殖利率評價</a></li-->
                            </ul>
                        </li>
                        <!--li role="separator" class="divider"></li-->
                    </ul>
                </li>

                <li class=" {{ active(['blogs','archives']) }}">
                    <a class="nav-font" href="{{ route('blogs') }}">
                        <i class="fas fa-pencil-alt"></i> 優分析專欄 
                    </a>
                </li>

                <li class="{{ active(['forum*', 'threads*', 'thread','forum.tag']) }}">
                    <a class="nav-font" href="{{ route('forum') }}">
                    <i class="far fa-comment-alt"></i>  討論區 
                    </a>
                </li>

                <li class="dropdown {{ active('Tools*') }}">
                    <a href="#" class="dropdown-toggle nav-font down" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calculator"></i>  小工具  <span class="triangle-down"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdownlist">
                            <a class="menu" href="#">計算股票價值<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.buffett') }}">巴菲特預估股價</a></li>
                                <li><a href="{{ route('Tools.deposit') }}">定存股價值試算表</a></li>
                                <li><a href="{{ route('Tools.proportion') }}">本益成長比</a></li>
                                <li><a href="{{ route('Tools.gordon') }}">高登模型</a></li>
                                <li><a href="{{ route('Tools.secondDCF') }}">兩階段 現金流折現模型 DCF</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">買賣股票試算<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.money') }}">除權息參考價</a></li>
                                <li><a href="{{ route('Tools.bargain') }}">損益試算</a></li>
                                <li><a href="{{ route('Tools.DepositInGroup') }}">揪團買股</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">投資檢查表<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.buyCheckForm') }}">股票買進檢查表</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">營收盈餘預估<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.Compound') }}">年複合成長率</a></li>
                                <li><a href="{{ route('Tools.estimate') }}">市占率預估</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">投資屬性測驗<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.DepositTest') }}">存股性向測驗</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">資本規劃試算<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.npv') }}">NPV計算機</a></li>
                            </ul>
                        </li>
                        <li class="dropdownlist">
                            <a class="menu" href="#">理財小工具<i class="fas fa-caret-right"></i></a>
                            <ul class="dropdown-content dropdown-menu">
                                <li><a href="{{ route('Tools.interest') }}">複利計算</a></li>
                                <li><a href="{{ route('Tools.PayBack') }}">貸款試算</a></li>
                                <li><a href="{{ route('Tools.retire') }}">退休規劃</a></li>
                                <li><a href="{{ route('Tools.lowestRetire') }}">最低退休金</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="https://pro.uanalyze.com.tw" class="nav-font pro" target="_blank" rel="noreferrer">
                        <img src="{{env('APP_URL')}}/images/logo_colour.svg" style="width:20px;">
                        <div style="display: inline-block;">優分析pro</div>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ active('login') }}"><a style="display:-webkit-box;" class="login" href="{{ route('login') }}">登入</a></li>
                    <li class="{{ active('register') }}"><a class="login" href="{{ route('register') }}">註冊</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-label="會員清單">
                        <img src="/images/icon/userLogin.svg" style="width:30px;" alt="missing user photo"> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <span>
                                    <strong>{{ Auth::user()->name() }}</strong>
                                </span>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li class="{{ active('dashboard') }}"><a class="user" href="{{ route('dashboard') }}">個人頁面</a></li>
                            <li class="{{ active('settings.*') }}"><a class="user" href="{{ route('settings.profile') }}">設定</a></li>

                            @can(App\Policies\UserPolicy::ADMIN, App\User::class)
                                <li role="separator" class="divider"></li>
                                <li class="{{ active('admin*') }}"><a class="user" href="{{ route('admin') }}">管理者</a></li>
                            @endcan

                            <li role="separator" class="divider"></li>
                            <li><a class="user" href="{{ route('logout') }}">登出</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


