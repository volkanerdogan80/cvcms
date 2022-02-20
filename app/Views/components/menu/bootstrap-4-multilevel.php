<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.dropdown-menu', function (e) {
            e.stopPropagation();
        });
        if ($(window).width() < 992) {
            $('.dropdown-menu a').click(function (e) {
                e.preventDefault();
                if ($(this).next('.submenu').length) {
                    $(this).next('.submenu').toggle();
                }
                $('.dropdown').on('hide.bs.dropdown', function () {
                    $(this).find('.submenu').hide();
                })
            });
        }
    });
</script>

<style type="text/css">
    @media (min-width: 992px) {
        .dropdown-menu .dropdown-toggle:after {
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;
        }

        .dropdown-menu .dropdown-menu {
            margin-left: 0;
            margin-right: 0;
        }

        .dropdown-menu li {
            position: relative;
        }

        .nav-item .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .nav-item .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu > li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu > li:hover > .submenu {
            display: block;
        }
    }
</style>

<?= cve_menu($key, [
    'menu_open' => '<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
    <ul class="navbar-nav">',
    'menu_item' => '<li class="nav-item"><a class="nav-link" href="%s"> %s </a></li>',
    'menu_close' => '</ul></div></nav>',
    'child_open' => '<li class="nav-item dropdown">',
    'child_first_item' => '<a class="nav-link dropdown-toggle" href="%s" data-toggle="dropdown"> %s </a>',
    'child_open_item' => '<ul class="dropdown-menu">',
    'child_item' => '<li><a class="dropdown-item" href="%s"> %s </a></li>',
    'child_close_item' => '</ul>',
    'child_close' => '</li>',
    'deep_open' => '<li>',
    'deep_first_item' => '<a class="dropdown-item" href="%s"> %s </a>',
    'deep_open_item' => '<ul class="submenu dropdown-menu">',
    'deep_item' => '<li><a class="dropdown-item" href="%s">%s</a></li>',
    'deep_close_item' => '</ul>',
    'deep_close' => '</li>',
]); ?>

