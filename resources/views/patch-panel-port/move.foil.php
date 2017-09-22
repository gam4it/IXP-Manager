<?php
/** @var Foil\Template\Template $t */

$this->layout( 'layouts/ixpv4' )
?>

<?php $this->section( 'title' ) ?>
    Move Patch Panel Port - <?= $t->ee( $t->ppp->getPatchPanel()->getName() ) ?> :: <?= $t->ee( $t->ppp->getName() )?>
<?php $this->append() ?>

<?php $this->section( 'content' ) ?>

    <div class="well">
        <?= Former::open()->method( 'POST' )
            ->action( action ( 'PatchPanel\PatchPanelPortController@move' ) )
            ->customWidthClass( 'col-sm-3' )
        ?>


            <?= Former::text( 'current-pos' )
                ->label( 'Current position :' )
                ->value( $t->ee( $t->ppp->getPatchPanel()->getName() ) . ' :: ' . $t->ee( $t->ppp->getName() ) )
                ->blockHelp( 'The current patch panel and port.' )
                ->disabled( true );
            ?>

            <?= Former::select( 'pp' )
                ->label( 'New Patch Panel:' )
                ->placeholder( 'Choose a Patch Panel' )
                ->options( $t->ppAvailable )
                ->addClass( 'chzn-select' )
                ->blockHelp( 'The new patch panel to move this port to.' );
            ?>

            <?= Former::select( 'master-port' )
                ->label( 'New Port:' )
                ->placeholder( 'Choose a port' )
                ->addClass( 'chzn-select' )
                ->blockHelp( 'The new port to move to.' );
            ?>

            <?php if( $t->ppp->hasSlavePort() ): ?>
                <?= Former::select( 'slave-port' )
                    ->label( 'New Slave/Duplex Port:' )
                    ->placeholder( 'Choose a Duplex port' )
                    ->addClass( 'chzn-select' )
                    ->blockHelp( 'The original port is a duplex port so you must also chose the slave/partner/duplex port here.' );
                ?>
            <?php endif; ?>



        <?= Former::hidden( 'id' )
            ->value( $t->ppp->getId() )
        ?>

        <?= Former::hidden( 'has-duplex' )
            ->value( $t->ppp->hasSlavePort() ? true : false )
        ?>

        <?=Former::actions(
            Former::primary_submit( 'Save Changes' ),
            Former::default_link( 'Cancel' )->href( route ( 'patch-panel-port/list/patch-panel' , [ 'id' => $t->ppp->getPatchPanel()->getId() ] ) ),
            Former::success_button( 'Help' )->id( 'help-btn' )
        )->id('btn-group');?>

        <?= Former::close() ?>
    </div>
<?php $this->append() ?>

<?php $this->section('scripts') ?>
    <script>
        $( document ).ready(function() {
            $( "#pp" ).change(function(){
                setPPP();
            });

            <?php if( $t->ppp->hasSlavePort() ): ?>
                $( "#master-port" ).change(function(){
                    nextPort = parseInt($( "#master-port" ).val()) + parseInt(1);
                    if( $( '#slave-port option[value="'+nextPort+'"]' ).length ) {
                        $( '#slave-port' ).val( nextPort );
                        $( '#slave-port' ).trigger("changed");
                    }
                });
            <?php endif; ?>
        });


        /**
         * set all the Patch Panel Panel Port available for the Patch Panel selected
         */
        function setPPP(){
            $( "#master-port" ).html( "<option value=\"\">Loading please wait</option>\n" ).trigger( "changed" );
            <?php if( $t->ppp->hasSlavePort() ): ?>
                $( "#slave-port" ).html( "<option value=\"\">Loading please wait</option>\n" ).trigger( "changed" );
            <?php endif; ?>

            ppId = $( "#pp" ).val();

            url = "<?= url( '/api/v4/patch-panel' )?>/" + ppId + "/patch-panel-port-free";
            datas = {pppId: <?= $t->ppp->getId() ?> };
            $.ajax( url , {
                data: datas,
                type: 'POST'
            })
                .done( function( data ) {
                    var options = "<option value=\"\">Choose a switch port</option>\n";
                    $.each( data.listPorts, function( key, value ){
                        options += "<option value=\"" + key + "\">" + value + "</option>\n";
                    });
                    $( "#master-port" ).html( options );
                    <?php if( $t->ppp->hasSlavePort() ): ?>
                        $( "#slave-port" ).html( options );
                    <?php endif; ?>
                })
                .fail( function() {
                    throw new Error( "Error running ajax query for api/v4/patch-panel/$id/patch-panel-port-free" );
                    alert( "Error running ajax query for api/v4/patch-panel/$id/patch-panel-port-free" );
                })
                .always( function() {
                    $( "#master-port" ).trigger( "changed" );
                    <?php if( $t->ppp->hasSlavePort() ): ?>
                        $( '#slave-port' ).trigger("changed");
                    <?php endif; ?>
                });
        }
    </script>
<?php $this->append() ?>