////////////////////////////////////////////////////////////////////////////////
//                      
//                      multiselect & autocomplete                            //
//                      
////////////////////////////////////////////////////////////////////////////////
///*
// * inputbox allows for text entry
// * text entry shwos select box with matching results
// * clicking result adds selected to list and (hidden) input field, carrying the indexes
// * 
// * needs: 
// * data-name="name": defining the name of the input AND the name of the variable holding the json arrObj with id/name Data
// * window[name]: json arrObj with id/name Data
// * 
// * HTML BASE
//   <div class="multiselect" data-name="verwandt">
//               <script>
//                   window.verwandt = <?php echo mh::getSchadenAsJson($lang); ?>
//               </script>
//               <input type="hidden" name="verwandt" value="<?php echo $item->verwandt ?>" >  <!-- selected items for data transport -->
//               <input class="textentry" placeholder="Eingabe für Auswahl">
//               <div class="selectList hidden"></div> <!-- select list -->
//               <div class="showSelected"></div> <!-- display selected items -->
//   </div>




// generate visible tag list of already selected values upon load
$('.multiselect').each(function () {
    var msBox = $(this);
    var name = $(this).data('name');
    var json = window[name]; // read data from accordingly called variable  
    console.log(json);
    var val = $("input[name='" + name + "']").val();
    var arrVals = [];
    if (typeof val !== 'undefined') {
        arrVals = val.split(',');
    }
    console.log(arrVals);

    if (arrVals > 0 || arrVals.length > 0) { // if single result or arr
        $.each(arrVals, function (i, val) {
            if (val > 0) {
                var obj = getById(json, val);
                console.log(obj);
                var tag = "<a class='tag' data-id='" + obj.id + "' >" + obj.name + "</a>";
                $(msBox).find('.showSelected').append(tag); // show tag
            }
        });
    } else {
        console.log(name + " without value");
    }
});





//show select box on click already
$('.multiselect input').click(function () {
    $(this).trigger('keyup');
});


$('.multiselect input').keyup(function () {
    var msBox = $(this).parent('div');
    var name = $(msBox).data('name');
    var json = window[name]; // read data from accordingly called variable

    var selectList = $(msBox).find('.selectList');

    $(selectList).removeClass('hidden').html('');

    var inp = $(this).val().toLowerCase(); // get text entered by user
    var len = inp.length;

    $(json).each(function (index, item) {
        var subName = item.name.substr(0, len).toLowerCase();
        if (inp == subName) {
            $(selectList).append("<a  data-id='" + item.id + "'>" + item.name + "</a>");
        }
    });
});


// add new selections
$('body').on('click', ".selectList a", function (e) {
    e.preventDefault();
    e.stopPropagation();

    var msBox = $(this).parents('div.multiselect');
    var name = $(msBox).data('name');

    var id = $(this).data('id');
    var tag = "<a class='tag' data-id='" + id + "' >" + $(this).html() + "</a>";

    $(msBox).find('.showSelected').append(tag); // show tag
    $('.selectList').addClass('hidden');
    $('input[name="' + name + '"]').val(id + "," + $('input[name="' + name + '"]').val()); // add value of selected sorte 
    $('.textentry').val(''); // clear input field

});


// delete selected tag
$('body').on('click', '.multiselect a.tag', function (e) {
    var msBox = $(this).parents('div.multiselect');
    var name = $(msBox).data('name');
    var id = $(this).data('id');
    var val = $("input[name='" + name + "']").val()
    console.log(val);
    var arrValues = val.split(','); // split value for processing
    $(arrValues).each(function (index, value) {
        if (value == id) {
            var popid = index;
            arrValues.splice(popid, 1);
            false;
        }
    });

    // set new value for field
    $("input[name='" + name + "']").val(arrValues.join());
    $(this).remove();
});



// hide selectbox on empty click
$('.multiselect').click(function(){
   $('.selectList').addClass('hidden'); 
});
