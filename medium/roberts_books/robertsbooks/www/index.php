<?php
require_once 'header.php';
?>
<div class="page-header">
  <h3>My name's Robert and I like books. Feel free to check out my collection:</h3>
</div>
<div class="well">
  <form class="form-inline" onsubmit="return false">
    <div class="form-group">
      <label class="" for="search"></label>
      <input type="text" class="form-control input-lg" id="query" placeholder="Enter keyword">
    </div>
    <button id="search" type="button" class="btn input-lg btn-secondary">Search</button>
  </form>
</div>
<div>
  <legend>
    <h4>Search Results:</h4>
  </legend>
  <div id="notFound" class="alert alert-info">
    <strong>oh no! It doesn't look like I have a book matching that search criteria</strong>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Publish Date</th>
      </tr>
    </thead>
    <tbody id="results">
    </tbody>
  </table>
</div>
<script>
  $(function(){
    var getBooks = function (searchQuery) {
      $("#notFound").hide();
      $("#results").html('');

      var verification = md5(searchQuery);
      searchQuery = searchQuery.replace(/\s/gi, '');
      searchQuery = searchQuery.replace("'", "", 'g');

      var body = {
        searchQuery: searchQuery,
        verification: verification
      };

      $.post('search.php', body, function (data) {
        if (!data) data = [];
        if (data.length == 0) {
          $("#notFound").show();
        }
        else {
          data.forEach(function(book) {
            var template = "<tr>" +
              "<td>" + book.title + "</td>" +
              "<td>" + book.author + "</td>" +
              "<td>" + book.published + "</td>" +
              "</tr>";

            $("#results").append(template);
          });
        };
      });
    };

    // Onload, get all books
    getBooks('');

    $("#search").click(function(){
      var searchQuery = $("#query").val();
      getBooks(searchQuery);
    });
  });
</script>
<?php
require_once 'footer.php';
?>
