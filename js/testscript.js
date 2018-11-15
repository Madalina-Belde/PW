$(function()
{
    $('p#p1').css('color', 'red');

    $('button#fadeoutbutton').click(function()
    {
        $('p#p1').slideUp();
    });

    $('button#fadeinbutton').click(function()
    {
        
        $('#p1').slideDown();
    });

}
)