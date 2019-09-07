$(document).ready(function () {
    // general setup
    var $divAddresses = $('#addresses');
    var $divPagination = $('#pagination');
    function getData(query) {
        return $.ajax({
            type: "POST",
            url: "system/get-addresses.php",
            data: query,
            dataType: 'json',
            cache: false
        });
    }

    // when page loads, load all data
    var fireAjaxLoadData = function (query) {
        getData(query).done(function (html) {
            $divAddresses.html(html.addresses);
            $divPagination.html(html.pagination);
        }).fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            $divAddresses.html("Error! Request Failed: " + err);
        });
    };
    fireAjaxLoadData();

    // when user clicks on pagination links
    $divPagination.on("click", ".pagination a", function (e) {
        e.preventDefault();

        // get page number from link and pass it as query
        var page = $(this).attr("data-page");
        var query = {};
        query.page = page;

        fireAjaxLoadData(query);
    });
});
