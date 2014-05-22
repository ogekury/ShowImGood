

// Dom object to manage html
var dom ={
    init: function(){
        $(".close").click(function(){
            dom.slideInOut();
        });
        
        $("#txt").focus(function(){
            $(this).val('')
        });
        
        $(".seemore").on('click',function(){
            $('.time-res').fadeIn();
            dom.seeMoreCtrl('close');
            return false;
        });
    },
    // open display
    clickOp:function(){
        this.close();
        this.slideInOut();
    },
    // close display
    close: function(){
        $("#results").hide();
    },
    // slide effect display
    slideInOut : function(){
        $("#results").slideToggle('slow');
    },
    // see more lose effect
    seeMoreCtrl: function(opencls){
        if(opencls == 'open'){
            $('.seemore').fadeIn('slow');    
        }else if(opencls == 'close'){
            $('.seemore').hide();    
        }
    },
    //manage search
    searchError: function(error){
        var msg = '';
        switch(error){
            case 'ZERO_RESULTS':
                var loc = $('#txt').val();
                msg = 'We could not find '+loc+', please try again';
            break;
            case 'NO_BUS_STOP':
                msg = 'No bus stops in this location';
            break;
            default:
                msg = 'Undefined error';
            break;    
        }
        $(".error").html(msg);
        $(".error").fadeIn();
    },
    //hide error
    hideError: function(){
        $(".error").hide();
    }
}

