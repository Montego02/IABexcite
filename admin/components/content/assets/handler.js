

  console.log(cat);
  
    if (cat > 0) {
        $('.cats [value="'+cat+'"]').attr('selected', 'selected');
        var catname =  $('.cats [value="'+cat+'"]').html();
        $('#catname').html(" / Kategorie "+catname);
    }
