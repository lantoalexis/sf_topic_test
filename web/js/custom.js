/* =============================================================================================================================*/
/* début: Demande_offre                                                                                                  */
/* =============================================================================================================================*/


(function( $ ) {


    'use strict';



    $(function() {
        if($('#_topic_').length > 0){
            $('._topic_').addClass('active');
        }
        if($('#_user_').length > 0){
            $('._user_').addClass('active');
        }
        if($('#_user_view_topic_').length > 0){
            $('._user_view_topic_').addClass('active');
        }
        if($('#_search_').length > 0){
            $('._search_').addClass('active');
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