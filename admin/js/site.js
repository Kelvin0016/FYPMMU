//sidebar menu
$('.menu-btn').click(function(){
  $(this).toggleClass("click");
  $('.sidebar').toggleClass("show");
  $('.pg-content').toggleClass("opacity");
  });
$('.event-btn').click(function(){
    $('nav ul .event-show').toggleClass("show");
    $('nav ul .first').toggleClass("rotate");
  });
$('.item-btn').click(function(){
    $('nav ul .item-show').toggleClass("show1");
    $('nav ul .second').toggleClass("rotate");
  });
  $('.pack-btn').click(function(){
    $('nav ul .pack-show').toggleClass("show2");
    $('nav ul .third').toggleClass("rotate");
  });
  $('.admin-btn').click(function(){
    $('nav ul .admin-show').toggleClass("show3");
    $('nav ul .fourth').toggleClass("rotate");
  });
  $('.venue-btn').click(function(){
    $('nav ul .venue-show').toggleClass("show4");
    $('nav ul .fifth').toggleClass("rotate");
  });
  $('.voucher-btn').click(function(){
    $('nav ul .voucher-show').toggleClass("show5");
    $('nav ul .sixth').toggleClass("rotate");
  });
  $('nav ul li').click(function(){
      $(this).siblings().find("ul").removeClass("active show show1 show2 show3 show4 show5");
      $(this).siblings().find("span").removeClass("rotate");
    });

  //delelting confirmation swal
  function delConfirmation(durl){
        swal({
          title: 'Delete',
          text: 'Do You Want To Delete This?',
          icon: 'info',
          buttons: {
              cancel: 'No',
              Yes: true,
          },
      }).then((value) => {
          switch (value) {
          case 'Yes':
          location.href = durl;
          break;

  }
});
  };

  //item delete swal (package)
  function swDel(doc)
  {
    if(doc.checked == true)
    {
    swal({
      title: 'Delete Item',
      text: 'Do You Want To Delete This Item?',
      icon: 'info',
      buttons: {
          cancel: 'No',
          Yes: true,
      },
      }).then((value) => {
      switch (value) {
        case 'Yes':
        doc.checked = true;
        break;
        default:
        doc.checked = false;
        break;
      }
    })
    }
    else
    {
      swal({
        title: 'Undelete Item',
        text: 'Do You Want To Undelete it?',
        icon: 'info',
        buttons: {
            cancel: 'No',
            Yes: true,
        },
        }).then((value) => {
        switch (value) {
          case 'Yes':
          doc.checked = false;
          document.getElementById("delall").checked = false;
          break;
          default:
          doc.checked = true;
          break;
        }
      });
    }
  };
  //item delete all swal (package)
  function swDelA(doc)
  {
    var delall = document.getElementsByClassName("del");
    if(doc.checked == true)
    {
    swal({
      title: 'Delete All Item',
      text: 'Do You Want To Delete All Item?',
      icon: 'info',
      buttons: {
          cancel: 'No',
          Yes: true,
      },
      }).then((value) => {
      switch (value) {
        case 'Yes':
          for (var checkbox of delall) {
            checkbox.checked = doc.checked;
          }
        break;
        default:
        doc.checked = false;
        break;
      }
    })
    }
    else
    {
      swal({
        title: 'Undelete All Item',
        text: 'Do You Want To Undelete All Item?',
        icon: 'info',
        buttons: {
            cancel: 'No',
            Yes: true,
        },
        }).then((value) => {
        switch (value) {
          case 'Yes':
            for (var checkbox of delall) {
              checkbox.checked = doc.checked;
            }
          break;
          default:
          doc.checked = true;
          break;
        }
      });
    }
  };
  //restore item swal (package)
  function swRes(doc)
  {
    if(doc.checked == true)
    {
    swal({
      title: 'Restore Item',
      text: 'Do You Want To Restore This Item?',
      icon: 'info',
      buttons: {
          cancel: 'No',
          Yes: true,
      },
      }).then((value) => {
      switch (value) {
        case 'Yes':
        doc.checked = true;
        break;
        default:
        doc.checked = false;
        break;
      }
    })
    }
    else
    {
      swal({
        title: 'Unrestore Item',
        text: 'Do You Want To Unrestore it?',
        icon: 'info',
        buttons: {
            cancel: 'No',
            Yes: true,
        },
        }).then((value) => {
        switch (value) {
          case 'Yes':
          doc.checked = false;
          document.getElementById("resall").checked = false;
          break;
          default:
          doc.checked = true;
          break;
        }
      });
    }
  };
  //restore all item swal (package)
  function swResA(doc)
  {
    var resall = document.getElementsByClassName("res");
    if(doc.checked == true)
    {
    swal({
      title: 'Restore All Item',
      text: 'Do You Want To Restore All Item?',
      icon: 'info',
      buttons: {
          cancel: 'No',
          Yes: true,
      },
      }).then((value) => {
      switch (value) {
        case 'Yes':
          for (var checkbox of resall) {
            checkbox.checked = doc.checked;
          }
        break;
        default:
        doc.checked = false;
        break;
      }
    })
    }
    else
    {
      swal({
        title: 'Unrestore All Item',
        text: 'Do You Want To Unrestore All Item?',
        icon: 'info',
        buttons: {
            cancel: 'No',
            Yes: true,
        },
        }).then((value) => {
        switch (value) {
          case 'Yes':
            for (var checkbox of resall) {
              checkbox.checked = doc.checked;
            }
          break;
          default:
          doc.checked = true;
          break;
        }
      });
    }
  };
  //empty filter text box onchange of the select (filter type)
  $(".filter-type").change(function (){
    $(".filterText").val('');
    $(".highlight").removeAttr("style");
    var $rows = $("table tbody").find("tr");
    $rows.each(function(){
      $(this).css("display","");
    });
  });

  //filter function
  $(".filterText").on("keyup",function Filter(){
    var $rows = $("table tbody").find("tr");
    var rowCount=0;
    var result;
    var filterType = $(".filter-type").val();
    var filterText = $(".filterText").val();
    if(filterText!=null){
      if(filterType!=0){
        
        $rows.each(function(){
          var $this = $(this);
          result = $this.find("td:nth-child("+filterType+")").text();
          var FLCase = filterText.toLowerCase();
          var RLCase = result.toLowerCase();
          var modiWord = "";
          var cls = "";
          var bold = "";

          if(RLCase.includes(FLCase)){
            $this.css("display","");
            for(var i=0;i<result.length;i++){
              for(var j=0;j<FLCase.length;j++)
              if(result[i]==FLCase[j].toUpperCase() || result[i]==FLCase[j]){
                cls="yellow";
                bold = "bold";
              };
              modiWord += "<span class='highlight' style='background-color:"+cls+"; font-weight:"+bold+"'>"+result[i]+"</span>";
              cls="";
              bold="";
            };
            $this.find("td:nth-child("+filterType+")").html(modiWord);
           }else{
            $this.css("display","none");

          }

        });
      }else{
        swal({
          title: "Error",
          text: "Please Choose Filter Type",
          icon: "error",
        });
      }
    }
    
    $rows.each(function(){
      $this = $(this);
      if($this.css("display")=="none"){
        rowCount++;
      }
    });
    $(".noResultRow").remove();
    if(rowCount==$rows.length && $("noResultRow")){
      //$(".view-table tbody").append("<span class='noResultRow'>No Matches Found!</span>");
      swal({
        title: "Error",
        text: "No result found!",
        icon: "error",
      }).then(()=>{
        location.reload();
      });
      
    }
  });