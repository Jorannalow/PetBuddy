// JavaScript Document
$(document).ready(function(){
	
    filterSearch();	
    $('.animalDetails').click(function(){
        filterSearch();
    });	
});

/* Title: Product Filter Search with Ajax, PHP & MySQL
Author: PHPZAG Team
Date: 4/12/2019
Availability: https://www.phpzag.com/product-filter-search-with-ajax-php-mysql/
*/

function filterSearch(){
	$('.searchResult').html('<div id="loading">Loading ...</div>');

	var action = 'fetch_data';
	var gender = getFilterData('gender');
	var animaltype = getFilterData('animaltype');
	var breed = getFilterData('breed');

	$.ajax({
		url:"action.php",
		method:"POST",
		dataType: 'json',
		data:{action:action, gender:gender, animaltype:animaltype, breed:breed},
		success:function(data){
			$('.searchResult').html(data.html);
			console.log(data);
		}, 
		
        error : function(data) {
			console.log(data);
			console.log("error");
			$('.searchResult').html('Error occured.');
             alert(data);
        }          
    
	});
}

function getFilterData(className) {
	var filter = [];
	$('.'+className+':checked').each(function(){
		filter.push($(this).val());
		console.log($(this).val());
	});
	
	return filter;
}