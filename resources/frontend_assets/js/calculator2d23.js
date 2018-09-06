var fourFtBase = 2016;
    var sixFtBase = 4608;
    var currentBase = 0;
    var currentNBase = 0;
    var num4Feet = 0;
    var num6Feet = 0;
    var smallItems = 0;
    var mediumItems = 0;
    var largeItems = 0;
    var planBoxPrice=199;
    var planFourPrice=1499;
    var planSixPrice=2999;
    
function setCity(el){
	if(el.value=="Pune"){
		planFourPrice=999;
		planSixPrice=1999;
	}else if(el.value=="Banglore"){
		planFourPrice=999;
		planSixPrice=1999;
	}else{
		planFourPrice=1499;
		planSixPrice=2999;
	}
	calculateStorage();
}

$(document).ready(function() {
  	
    $(".custom-button").click(function(){
    	$(".add-section").hide();
    	$(".custom-section").show();
    	$(".itd-in-footer").show();
    	$(".itd-in-footer input[type=checkbox]").attr("checked", false);
    	$(".itd-in-footer input[type=text]").val("");
    	$(".length").val("");
    	$(".width").val("");
    });
  
    $(".selected .footer").on('click', '.cancel-adding', function(){
     	$(".add-section").show();
    	$(".custom-section").hide();
    });
    
    $(".selected .footer").on('change', '.itd-in-footer input[type="checkbox"]', function(){
        if ($(this).prop("checked")) {
          $(this).parent().parent().parent().toggle("slow", function(){
            var id = 'custom-item';
            var quantity = $(this).find("input[type='number']").val();
            var text = $(this).find("input[type='text']").val();
            var length = $(".length").val();
            var width = $(".width").val();
            var size = $(".size-options.active").attr("size");
            var parts = $(".size-options.active").attr("parts");
            var base = 0;
            var nBase = 0;
            if (size == "small") {
            	nBase = parseInt(length) * parseInt(width) * 144;
                smallItems = smallItems + 1 * parseInt(quantity);
            } else if (size == "medium") {
            	base = parseInt(length) * parseInt(width) * 144;
            	if (parts) {
            		mediumItems = mediumItems + 1 * parseInt(quantity) * parseInt(parts);
            	} else{
            		mediumItems = mediumItems + 1 * parseInt(quantity);
            	}
            } else {
            	base = parseInt(length) * parseInt(width) * 144;
            	if (parts) {
            		largeItems = largeItems + 1 * parseInt(quantity) * parseInt(parts);
            	} else {
            		largeItems = largeItems + 1 * parseInt(quantity);
            	}
            }
            currentBase = currentBase + (parseInt(base) * parseInt(quantity));
            currentNBase = currentNBase + (parseInt(nBase) * parseInt(quantity));
            
            calculateStorage();
            addToSelected(id, quantity, text, base, nBase, size, parts);
            $(".add-section").show();
    		$(".custom-section").hide();
          });
        }
    });
    
    $(".selected .footer").on('click', '.sizes .size-options', function(){
      $(".sizes .size-options").each(function() {
       $(this).removeClass("active"); 
      });
      $(this).addClass("active");
    });
     
     jQuery.expr[':'].Contains = function(a,i,m){
		  return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	  };
	  
	  $(".search").change( function () {
			var filter = $(this).val();
			if(filter) {
			  $(".list").find("h4:not(:Contains(" + filter + "))").parents("li.item").slideUp();
			  $(".list").find("h4:Contains(" + filter + ")").parents("li.item").slideDown();
			} else {
			  $(".list").find("li").slideDown();
			}
			return false;
		  })
		.keyup( function () {
			$(this).change();
		});
    
  
    function addToSelected(id, quantity, text, base, nBase, size, parts){
      if (parts) {
    	  $('.selected .body').append('<div class="added-item container-fluid" id="'+ id +'duplicate" base="' + base + '" nBase="' + nBase + '" size="' + size + '" parts="' + parts + '" ><div class="row"><h4 class="col-xs-7">'+ text +'</h4><div class="col-xs-3"> <input disabled="disabled" type="number" min="0" class="form-control" value="'+ quantity +'"></div><div class="col-xs-2"><span class="cancel-item">&#10006;</span></div></div></div>');
      } else {
    	  $('.selected .body').append('<div class="added-item container-fluid" id="'+ id +'duplicate" base="' + base + '" nBase="' + nBase + '" size="' + size + '"  ><div class="row"><h4 class="col-xs-7">'+ text +'</h4><div class="col-xs-3"> <input disabled="disabled" type="number" min="0" class="form-control" value="'+ quantity +'"></div><div class="col-xs-2"><span class="cancel-item">&#10006;</span></div></div></div>');
      }
      var items = "";
      $(".added-item h4").each(function() {
    	  items = items + " " + $(this).text();
      });
      $("input[name=spaceItems]").val(items);
    }
   
    
    
    $('.item-to-add input[type="checkbox"]').change(function(){
        if ($(this).prop("checked")) {
          $(this).parent().parent().parent().toggle("slow", function(){
            var id = $(this).attr('id');
            var quantity = $(this).find("input[type='number']").val();
            var text = $(this).find("h4").text();
            var base = $(this).attr("base");
            var nBase = $(this).attr("nBase");
            var size = $(this).attr("size");
            var parts = $(this).attr("parts");
            currentBase = currentBase + (parseInt(base) * parseInt(quantity));
            currentNBase = currentNBase + (parseInt(nBase) * parseInt(quantity));
            if (size == "small") {
            	smallItems = smallItems + 1 * parseInt(quantity);
            } else if (size == "medium") {
            	if (parts) {
            		mediumItems = mediumItems + 1 * parseInt(quantity) * parseInt(parts);
            	} else{
            		mediumItems = mediumItems + 1 * parseInt(quantity);
            	}
            } else {
            	if (parts) {
            		largeItems = largeItems + 1 * parseInt(quantity)  * parseInt(parts);
            	} else {
            		largeItems = largeItems + 1 * parseInt(quantity);
            	}
            }
            //console.log("Current Base " + currentBase);
    		//console.log("Current NonBase " +currentNBase);
            calculateStorage();
            addToSelected(id, quantity, text, base, nBase, size, parts);
          });
        }
      });
      
    $(".selected .body").on('click', '.added-item .cancel-item', function() {
      $(this).parent().parent().parent().toggle("slow", function(){
        var id = $(this).attr('id');
        var id = id.split("duplicate", 2)[0];
        var base = $(this).attr("base");
        var nBase = $(this).attr("nBase");
        var quantity = $(this).find("input[type='number']").val();
   		var size = $(this).attr("size");
   		var parts = $(this).attr("parts");
   		
        currentBase = currentBase - (parseInt(base) * parseInt(quantity));
        currentNBase = currentNBase - (parseInt(nBase) * parseInt(quantity));
        if (size == "small") {
            smallItems = smallItems - 1 * parseInt(quantity);
        } else if (size == "medium") {
        	if (parts) {
        		mediumItems = mediumItems - 1 * parseInt(quantity) * parseInt(parts);
        	} else{
        		mediumItems = mediumItems - 1 * parseInt(quantity);
        	}
        } else {
        	if (parts) {
        		largeItems = largeItems - 1 * parseInt(quantity) * parseInt(parts);
        	} else {
        		largeItems = largeItems - 1 * parseInt(quantity);
        	}
        }
        
        calculateStorage();
        $('.all .body #' + id).toggle("slow", function(){
          $(this).find('input[type="checkbox"]').prop('checked', false);
        });
        });
      });
      
    });

function calculateStorage() {
	var fourFtNum = 0;
	var sixFtNum = 0;
	var baseRequired = 0;
	if (currentNBase > currentBase) {
		baseRequired = currentBase + (currentNBase - currentBase) / 2;
	} else if (currentBase <= 0){
		baseRequired = currentNBase / 2;
	} else {
		baseRequired = currentBase;
	}
	console.log(largeItems);
	//console.log("Base Required " + baseRequired);
	if (baseRequired / sixFtBase > 1) {
		sixFtNum = Math.round(baseRequired / sixFtBase);
		var remainingSpace = baseRequired - (sixFtNum * sixFtBase);
		if (remainingSpace / fourFtBase > 1) {
			sixFtNum = sixFtNum + 1;
		} else {
			fourFtNum = 1;
		}    		
	} else if (baseRequired / fourFtBase > 1) {
		sixFtNum = 1;
	} else if (largeItems > 0) {
		sixFtNum = 1;
	} else {
		fourFtNum = 1;
	}
	
	var currentCalculation = "";
	var storageCost = "";
	var packingCost = "";
	var costPacking = 0;
	if (sixFtNum >= 1 && fourFtNum >= 1) {
		console.log("if");
		currentCalculation = "<b>6ft plan &nbsp; &nbsp; X &nbsp; &nbsp; " + sixFtNum + ",&nbsp; &nbsp;" + "4ft plan &nbsp; &nbsp; X &nbsp; &nbsp; " + fourFtNum + "</b>";
		storageCost = "Storage: &nbsp;&nbsp; Rs. "+planSixPrice+" &nbsp; X &nbsp;" + sixFtNum + "&nbsp;+ &nbsp; Rs. "+planFourPrice+" &nbsp; X &nbsp;" + fourFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (planSixPrice * sixFtNum + planFourPrice * fourFtNum) + "&nbsp;&nbsp;" + "(Storage)";
		pickupCost = "Pickup: &nbsp;&nbsp; Rs. 2999 &nbsp; X &nbsp;" + sixFtNum + "&nbsp;+ &nbsp; Rs. 1499 &nbsp; X &nbsp;" + fourFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (2999 * sixFtNum + 1499 * fourFtNum) + "&nbsp;&nbsp; (" + (sixFtNum * 3 + fourFtNum * 1) + " Movers, " +  (sixFtNum == 1 ? "10ft truck" : sixFtNum == 2 ? "14ft truck" : "17ft truck") +  " )";
	} else if (sixFtNum >= 1) {
		console.log("else if");
		currentCalculation = "<b> 6ft plan &nbsp; &nbsp; X &nbsp; &nbsp; " + sixFtNum + "</b>";
		storageCost = "Storage: &nbsp;&nbsp;Rs. "+planSixPrice+" &nbsp; X &nbsp;" + sixFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (planSixPrice * sixFtNum) + "&nbsp;&nbsp; (Storage)";
		pickupCost = "Pickup: &nbsp;&nbsp; Rs. 2999 &nbsp; X &nbsp; " + sixFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (2999 * sixFtNum) + "&nbsp;&nbsp; (" + sixFtNum * 3 + " Movers, " +  (sixFtNum == 1 ? "7ft truck" : sixFtNum == 2 ? "14ft truck" : "17ft truck") + " )";
	} else {
		console.log("else");
		currentCalculation = "<b> 4ft plan &nbsp; &nbsp; X &nbsp; &nbsp; " + fourFtNum + "</b>";
		storageCost = "Storage: &nbsp;&nbsp;Rs. "+planFourPrice+" &nbsp; X &nbsp; " + fourFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (planFourPrice * fourFtNum) + "&nbsp;&nbsp; (Storage)";
		pickupCost = "Pickup: &nbsp;&nbsp; Rs. 1499 &nbsp; X &nbsp;  " + fourFtNum + "&nbsp; &nbsp; = &nbsp; &nbsp;" + (1499 * fourFtNum) + "&nbsp;&nbsp; (" + fourFtNum * 2 + " Movers, " +  (fourFtNum == 1 ? "7ft truck" : fourFtNum == 2 ? "10ft truck" : "14ft truck") + " )";
	}
	
	if (smallItems > 0) {
		packingCost = packingCost  + "Rs. 99 &nbsp; X &nbsp; " + smallItems;
		costPacking = costPacking + smallItems * 99;
	}
	
	if (mediumItems > 0) {
		packingCost = packingCost  + "Rs. 199 &nbsp; X &nbsp; " + mediumItems;
		costPacking = costPacking + mediumItems * 199;
	}
	
	if (largeItems > 0) {
		packingCost = packingCost  + "Rs. 299 &nbsp; X &nbsp; " + largeItems;
		costPacking = costPacking + largeItems * 299;
	}
	
	if (costPacking > 0)
		packingCost = packingCost  + "&nbsp; &nbsp; = &nbsp; &nbsp;" + costPacking + "&nbsp; &nbsp; (Packing, if required)";
	
	//if (currentCalculation != $(".estimated").html()) {
		$("input[name=fourFeetPlan]").val(fourFtNum);
		$("input[name=sixFeetPlan]").val(sixFtNum);
    	$(".estimated").fadeOut(100, function() {
    		$(".estimated").html(currentCalculation);
    		$(".estimated").fadeIn(200);
    		$(".storage-cost").html(storageCost);
    		$(".pickup-cost").html(pickupCost);
    	});
	//}
	$(".packing-cost").html("Packing: &nbsp;&nbsp;" + packingCost);
}