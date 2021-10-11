function deleteGenre(id){
    let confirm = window.confirm("Are you sure you want to delete?");
    if(confirm){
        window.location = "?mn=genre&tok=del&did="+id;
    }
}

function editGenre(id){
    window.location = "?mn=genreUpdate&uid=" +id;
}

function deleteBook(isbn){
    let confirm = window.confirm("Are you sure you want to delete?");
    if(confirm){
        window.location = "?mn=book&tok=del&did="+isbn;
    }
}

function editBook(isbn){
    window.location = 
    "?mn=bookUpdate&uid=" +isbn;
}