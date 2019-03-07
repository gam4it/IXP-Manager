<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?= $this->insert('layouts/ixp-logo-header'); ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <li class="nav-item <?= request()->is( 'dashboard' ) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= url('') ?>">
                   Home
                </a>
            </li>

            <li class="nav-item <?= !request()->is( 'contact/*' ) ?: 'active' ?>">
                <a class="nav-link" href="<?= route( 'contact@list' ) ?>">
                    Contacts
                </a>
            </li>

            <li class="nav-item <?= !request()->is( 'user/*' ) ?: 'active' ?>">
                <a class="nav-link" href="<?= route( 'user@list' ) ?>">
                    Users
                </a>
            </li>

            <li class="nav-item dropdown <?= !request()->is( 'customer/*', 'switch/configuration' ) ?: 'active' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Member Information
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item <?= !request()->is( 'customer/details' ) ?: 'active' ?>" href="<?= route('customer@details') ?>">
                        Member Details
                    </a>
                    <a class="dropdown-item <?= !request()->is( 'customer/associates' ) ?: 'active' ?>" href="<?= route( "customer@associates" ) ?>">
                        Associate Members
                    </a>
                    <a class="dropdown-item <?= !request()->is( 'switch/configuration' ) ?: 'active' ?>" href="<?= route('switch@configuration') ?>">
                        Switch Configuration
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown <?= !request()->is( 'peering-*' , 'lg', 'rs-prefixes/view/*' ) ?: 'active' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Peering
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if( !config( 'ixp_fe.frontend.disabled.peering-manager', false ) ): ?>
                        <a class="dropdown-item <?= !request()->is( 'peering-manager' ) ?: 'active' ?>" href="<?= route('peering-manager@index') ?>">
                            Peering Manager
                        </a>
                    <?php endif; ?>
                    <?php if( !config( 'ixp_fe.frontend.disabled.rs-prefixes', false ) ): ?>
                        <?php if( Auth::user()->getCustomer()->isRouteServerClient() ): ?>
                            <a class="dropdown-item <?= !request()->is( 'rs-prefixes/view/*' ) ?: 'active' ?>" href="<?= route('rs-prefixes@view', [ "id" => Auth::getUser()->getCustomer()->getId() ]) ?>">
                                Route Server Prefixes
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if( !config('ixp_fe.frontend.disabled.lg' ) ): ?>
                        <a class="dropdown-item <?= !request()->is( 'lg' ) ?: 'active' ?>" href="<?= url('lg') ?>">
                            Looking Glass
                        </a>
                    <?php endif; ?>
                    <?php if( ixp_min_auth( config( 'ixp.peering-matrix.min-auth' ) ) && !config( 'ixp_fe.frontend.disabled.peering-matrix', false ) ): ?>
                        <a class="dropdown-item <?= !request()->is( 'peering-matrix' ) ?: 'active' ?>" href="<?= route('peering-matrix@index') ?>">
                            Peering Matrix
                        </a>
                    <?php endif; ?>

                </div>

            </li>

            <?php
                // STATIC DOCUMENTATION LINKS - SPECIFIC TO INDIVIDUAL IXPS
                // Add a skinned file for your IXP to override the sample
                echo $this->insert('layouts/header-documentation');
            ?>

            <li class="nav-item dropdown <?= !request()->is( 'statistics/*', 'weather-map/*' ) ?: 'active' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Statistics
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item " href="<?= route( 'statistics@member' ) ?>"
                       My Statistics
                    </a>

                    <?php if( config('grapher.backends.sflow.enabled') ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/p2p/*' ) ?: 'active' ?>" href="<?= route( 'statistics@p2p', ['cid' => Auth::user()->getCustomer()->getId() ] ) ?>">
                            My Peer to Peer Traffic
                        </a>
                    <?php endif; ?>

                    <div class="dropdown-divider"></div>

                    <?php if( is_numeric( config( 'grapher.access.ixp' ) ) && config( 'grapher.access.ixp' ) <= Auth::user()->getPrivs() ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/ixp' ) ?: 'active' ?>" href="<?= route( 'statistics/ixp' ) ?>">
                            Overall Peering Graphs
                        </a>
                    <?php endif; ?>
                    <?php if( is_numeric( config( 'grapher.access.infrastructure' ) ) && config( 'grapher.access.infrastructure' )  <= Auth::user()->getPrivs() ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/infrastructure' ) ?: 'active' ?>" href="<?= route( 'statistics/infrastructure' ) ?>">
                            Infrastructure Graphs
                        </a>
                    <?php endif; ?>
                    <?php if( is_numeric( config( 'grapher.access.vlan' ) ) && config( 'grapher.access.vlan' ) <= Auth::user()->getPrivs() && config( 'grapher.backends.sflow.enabled' ) ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/vlan' ) ?: 'active' ?>" href="<?= route( 'statistics/vlan' ) ?>">
                            VLAN / Per-Protocol Graphs
                        </a>
                    <?php endif; ?>
                    <?php if( is_numeric( config( 'grapher.access.trunk' ) ) && config( 'grapher.access.trunk' ) <= Auth::user()->getPrivs() ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/trunk' ) ?: 'active' ?>" href="<?= route('statistics/trunk') ?>">
                            Inter-Switch / PoP Graphs
                        </a>
                    <?php endif; ?>
                    <?php if( is_numeric( config( 'grapher.access.switch' ) ) && config( 'grapher.access.switch' ) <= Auth::user()->getPrivs() ): ?>
                        <a class="dropdown-item <?= !request()->is( 'statistics/switch' ) ?: 'active' ?>" href="<?= route('statistics/switch') ?>">
                            Switch Aggregate Graphs
                        </a>
                    <?php endif; ?>

                    <?php if( $this->grapher()->canAccessAllCustomerGraphs() ): ?>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="<?= route( 'statistics/members' ) ?>">
                            Member Graphs
                        </a>

                    <?php endif; ?>



                    <?php if( is_array( config( 'ixp_tools.weathermap', false ) ) ): ?>

                        <div class="dropdown-divider"></div>

                        <?php foreach( config( 'ixp_tools.weathermap' ) as $k => $w ): ?>
                            <a class="dropdown-item <?= !request()->is( 'weather-map/'. $k ) ?: 'active' ?>" href="<?= route( 'weathermap' , [ 'id' => $k ] ) ?>">
                                <?= $w['menu'] ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= !request()->is(  'public-content/support' ) ?: 'active' ?>" href="<?= route( 'public-content', [ 'page' => 'support' ] ) ?>">
                    Support
                </a>
            </li>
        </ul>

        <ul class="navbar-nav mt-lg-0">
            <li class="nav-item dropdown <?= !request()->is( 'profile', 'api-key/list' ) ?: 'active' ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Account
                </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item <?= !request()->is( 'profile' ) ?: 'active' ?>" href="<?= route( 'profile@edit' ) ?>">
                        Profile
                    </a>

                    <a class="dropdown-item <?= !request()->is( 'api-key/list' ) ?: 'active' ?>" href="<?= route('api-key@list' )?>">
                        API Keys
                    </a>

                    <div class="dropdown-divider"></div>

                    <h6 class="dropdown-header">
                        Switch to :
                    </h6>

                    <?php foreach( Auth::getUser()->getCustomers() as $cust ): ?>
                        <a class="dropdown-item <?= Auth::getUser()->getCustomer()->getId() != $cust->getId() ?: 'active cursor-default' ?>" <?= Auth::getUser()->getCustomer()->getId() != $cust->getId() ?: "onclick='return false;'" ?> href="<?= Auth::getUser()->getCustomer()->getId() == $cust->getId() ? '#' : route( 'switch-customer@switch', [ "id" => $cust->getId() ] ) ?>">
                            <?= $cust->getName() ?>
                        </a>

                    <?php endforeach; ?>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="<?= route( 'login@logout' ) ?>">
                        Logout
                    </a>

                </ul>
            </li>

            <li class="nav-item">
                <?php if( session()->exists( "switched_user_from" ) ): ?>
                    <a class="nav-link" href="<?= route( 'switch-user@switchBack' ) ?>">
                        Switch Back
                    </a>
                <?php else: ?>
                    <a class="nav-link" href="<?= route( 'login@logout' ) ?>">
                        Logout
                    </a>
                <?php endif; ?>
            <li>
        </ul>
    </div>
</nav>