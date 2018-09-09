/* =============================================================================================================================*/
/* début: Demande_offre                                                                                                  */
/* =============================================================================================================================*/


(function( $ ) {


    'use strict';



    $(function() {
        if($('#_home_').length > 0){
            $('._home_').addClass('active');
        }
        if($('#_user_').length > 0){
            $('._user_').addClass('active');
        }
        if($('#_personnel_').length > 0){
            $('._personnel_').addClass('active');
        }
        if($('#_conge_').length > 0){
            $('._conge_').addClass('active');
        }
        if($('#_permission_').length > 0){
            $('._permission_').addClass('active');
        }
        if($('#tout_le_personnel').length > 0){
            $('.tout_le_personnel').addClass('active');
        }
        if($('#personnel_par_direction').length > 0){
            $('.personnel_par_direction').addClass('active');
        }
        if($('#personnel_par_service').length > 0){
            $('.personnel_par_service').addClass('active');
        }

    });

}).apply( this, [ jQuery ]);