
// Init tabs and screenshots with correct state
$('#screenshot').removeClass();
if (window.location.hash == '#linux') {
    $('#screenshot').addClass('linux');
    $('.tabs a[href="#linux"]').addClass('selected');
} else if (window.location.hash == '#mac') {
    $('#screenshot').addClass('mac');
    $('.tabs a[href="#mac"]').addClass('selected');
} else {
    $('#windows').show();
    $('#screenshot').addClass('windows');
    $('.tabs a[href="#windows"]').addClass('selected');
}

// Switch screenshot and tabs when clicking on a tab
$('.tabs a').click(function (e) {
    e.preventDefault();
    // Make sure no panel is shown using CSS (remove hash)
    history.pushState("", document.title, window.location.pathname);

    // Remove class from all the tabs
    $('.tabs a').each(function() {
        $(this).removeClass('selected');
    });

    // Add 'selected' class to the clicked tab
    $(this).addClass('selected');

    // Hide all download panels
    $('.downloads').each(function() {
        $(this).hide();
    });

    // Switch screenshots and show download panel
    $('#screenshot').removeClass();
    if ($(this).children('span').hasClass('win')) {
        $('#screenshot').addClass('windows');
        $('#windows').show();
    } else if ($(this).children('span').hasClass('mac')) {
        $('#screenshot').addClass('mac');
        $('#mac').show();
    } else {
        $('#screenshot').addClass('linux');
        $('#linux').show();
    }
});