<style>
    .components p {
        font-size: 1em;
        font-weight: 500;
        line-height: 1.7em;
        color: #999 !important;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        /* margin-bottom: 40px; */
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
      SIDEBAR STYLE
  ----------------------------------------------------- */

    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background: var(--primary);
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar.active {
        margin-left: -250px;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: var(--primary);
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid var(--primary);
    }

    #sidebar ul p {
        color: #fff;
        padding: 0px 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: #fff;
        background: var(--primary_hover);
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: var(--primary_hover);
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #6d7fcc;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        color: #7386d5;
    }

    a.article,
    a.article:hover {
        background: #6d7fcc !important;
        color: #fff !important;
    }

    /* ---------------------------------------------------
      CONTENT STYLE
  ----------------------------------------------------- */

    #content {
        width: 100%;
        padding: 20px;
        min-height: 100vh;
        transition: all 0.3s;
    }

    /* ---------------------------------------------------
      MEDIAQUERIES
  ----------------------------------------------------- */

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }

        #sidebar.active {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }
    }
</style>
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3 class="text-center text-uppercase">{{ translate('messages.income_&_expenses') }}</h3>
    </div>

    <ul class="list-unstyled components">
        <p class="text-uppercase mb-0">{{ translate('messages.income_Section') }}</p>
        <li class="{{ request()->is('finance/income-category')  ? 'active' : ''}}">
            <a class="text-uppercase" href="{{ route('finance.income-category') }}">{{ translate('messages.income_category') }}</a>
        </li>
        <li class="{{ request()->is('finance/income')  ? 'active' : ''}}">
            <a class="text-uppercase" href="{{ route('finance.income.index') }}">{{ translate('messages.incomes') }}</a>
        </li>
        <p class="text-uppercase mb-0 mt-2">{{ translate('messages.expense_Section') }}</p>
        <li class="{{ request()->is('finance/expense-category')  ? 'active' : ''}}">
            <a class="text-uppercase" href="{{ route('finance.expense-category.index') }}">{{ translate('messages.expense_category') }}</a>
        </li>
        <li class="{{ request()->is('finance/expense')  ? 'active' : ''}}">
            <a class="text-uppercase" href="{{ route('finance.expense.index') }}">{{ translate('messages.expenses') }}</a>
        </li>
        <p class="text-uppercase mb-0 mt-2">{{ translate('messages.budgeting') }}</p>
        <li class="{{ request()->is('finance/savings')  ? 'active' : ''}}">
            <a class="text-uppercase" href="{{ route('finance.savings') }}">{{ translate('messages.savings') }}</a>
        </li>
    </ul>
</nav>
