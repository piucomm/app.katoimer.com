/**
 * Custom script
 * ------------------
 * 
 */


      //select all checkboxes
      $(".selectAll").change(function(){  //"select all" change 
          var status = this.checked; // "select all" checked status
          $('.checkbox').each(function(){ //iterate all listed checkbox items
              this.checked = status; //change ".checkbox" checked status
          });
      });

      $('.checkbox').change(function(){ //".checkbox" change 
          //uncheck "select all", if one of the listed checkbox item is unchecked
          if(this.checked == false){ //if this item is unchecked
              $(".selectAll")[0].checked = false; //change "select all" checked status to false
          }
          
          //check "select all" if all checkbox items are checked
          if ($('.checkbox:checked').length == $('.checkbox').length ){ 
              $(".selectAll")[0].checked = true; //change "select all" checked status to true
          }
      });

  /* restituisce il valore dei parametri in GET a Jquery */
  function getUrlParameter(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

      for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
              return sParameterName[1] === undefined ? true : sParameterName[1];
          }
      }
  };

// reload pagina
function reloadPage() {
  location.reload();
};


      function showOk(okMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultOK').css('display','block');
        $('#resultOK p').html(okMsg);
      }

      function hideOk(){
        $('#resultOK').css('display','none');
      }   

      function showError(errMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultKO').css('display','block');
        $('#resultKO p').html(errMsg);
      }

      function hideError(){
        $('#resultKO').css('display','none');
      }     


function showData(currentPage, itemsPerPage, typeToShow, strSearch){

  var showInfo = {
    Page: currentPage,
    TypeTS: typeToShow,
    Padre: 1,
    Attiva: 1,
    ItemPerPage: itemsPerPage,
    Search: strSearch
  };

  var jsonString = JSON.stringify(showInfo);

  $.ajax({
    type: "POST",
    url: "ajax/show.php",
    data: {data : jsonString},
    dataType: "json",
    beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
    success: function(data) {
      $('#ajax-loader').css('visibility','hidden');
      if(data.status == 1) {
        $('#showDataQuery').html(data.msg);
        $('.paginationRow').html(data.pag);

        $(".dropItemsNumber").change(function () {
          itemPerP = this.value;
          showData(now_page, itemPerP, "categorie");
        });

      } else {
        showError(" Loading data show: "+data.msg);
      }
    },
    error: function() {
      $('#ajax-loader').css('visibility','hidden');
      $('#resultKO').css('display','block');
      showError("Ajax sending data show...");
    }
  });
        
}


function removeData(itemsToRemove, typeToRemove){

  var removeInfo = {
    ItemsTR: itemsToRemove,
    TypeTR: typeToRemove
  };

  var jsonString = JSON.stringify(removeInfo);

  //var jsonString = JSON.stringify(itemsToRemove);
  console.log("Removing "+typeToRemove+" : "+jsonString);

  if (itemsToRemove.length != 0) {
    var r = confirm("Vuoi davvero eliminare?");
    if (r == true) {   
      $.ajax({
        type: "POST",
        url: "ajax/delete.php",
        data: {data : jsonString},
        dataType: "json",
        beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
        success: function(data) {
          $('#ajax-loader').css('visibility','hidden');
          if(data.status == 1) {
            showOk(data.msg);
            showData(1, $(".dropItemsNumber").value ,"categorie");
          } else {
            showError(" data : "+data.msg);
          }
        },
        error: function() {
            $('#ajax-loader').css('visibility','hidden');
            $('#resultKO').css('display','block');
            showError("Ajax sending data...");
        }
      });
      return false;
    } else {
      return false;
    } // end if confrim
  } else {
    showError("Selezionare almeno un contenuto da eliminare...");
  }

}