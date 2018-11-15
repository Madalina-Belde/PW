$(function()
{

    var clickedButton;
    var activeContent;
    var contactDiv = $('.contactDivClass');
    var aboutDiv = $('.aboutDivClass');
    var servicesDiv = $('.serviceDivClass');
    var roomsDiv = $('.roomsDivClass');
    var rezervaDiv = $('.rezervaDivClass');

    /**
     * initialize 
     */
     contactDiv.hide();
     servicesDiv.hide();
     roomsDiv.hide();
     rezervaDiv.hide();

     /* init modal */
     $('#roomsModal').on('show.bs.modal', function(){
        $('.modal .modal-body').css('overflow-y', 'auto');
        $('.modal .modal-body').css('max-height', $(window).height()*0.85);
     });

     clickedButton = $('button#aboutbutton');
     clickedButton.css("background", "#ffffff").css("color", "black");
     activeContent = aboutDiv;

    $('button#aboutbutton').click(function()
    {
        if(clickedButton != null)
        {
            clickedButton.css("background", "#910000").css("color", "ffd86d");
        }
        if(activeContent != null)
        {
            activeContent.hide();
        }
        activeContent = aboutDiv;
        activeContent.show();

        $(this).css("background", "#910000").css("color", "ffd86d");
        clickedButton = $(this);

    });


    $('button#roomsbutton').click(function() 
    {

        if(clickedButton != null)
        {
            clickedButton.css("background", "#910000").css("color", "ffd86d");
        }
        if(activeContent != null)
        {
            activeContent.hide();
        }
        activeContent = roomsDiv;
        activeContent.show();

        $(this).css("background", "#910000").css("color", "ffd86d");
        clickedButton = $(this);

    });



    $('button#contactbutton').click(function()
    {

        if(clickedButton != null)
        {
            clickedButton.css("background", "#910000").css("color", "ffd86d");
        }
        if(activeContent != null)
        {
            activeContent.hide();
        }

            activeContent = contactDiv;
            activeContent.show();
        

        $(this).css("background", "#910000").css("color", "ffd86d");
        clickedButton = $(this);

        contactDiv.show();
        
        var uluru = {lat: 47.518939, lng: 25.861876};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });

    });


    $('button#rezervabutton').click(function()
    {

        if(clickedButton != null)
        {
            clickedButton.css("background", "#910000").css("color", "ffd86d");
        }
        if(activeContent != null)
        {
            activeContent.hide();
        }

            activeContent = rezervaDiv;
            activeContent.show();
        

        $(this).css("background", "#910000").css("color", "ffd86d");
        clickedButton = $(this);


    });

   

    $('button#servicesbutton').click(function()
    {
        
        if(clickedButton != null)
        {
            clickedButton.css("background", "#910000").css("color", "ffd86d");
        }

        if(activeContent != null)
        {
            activeContent.hide();
        }
        activeContent = servicesDiv;
        activeContent.show();

        $(this).css("background", "#910000").css("color", "ffd86d");
        clickedButton = $(this);

    });

}

)