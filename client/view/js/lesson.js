const txt = document.getElementById("lesson").innerHTML;
document.getElementById("lesson").innerHTML = convertbbcode(txt);

function convertbbcode(str){

    // The array of regex patterns to look for
    const format_search =  [
        /\[b\](.*?)\[\/b\]/ig,
        /\[i\](.*?)\[\/i\]/ig,
        /\[u\](.*?)\[\/u\]/ig
    ]; // NOTE: No comma after the last entry

    // The matching array of strings to replace matches with
    const format_replace = [
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<span style="text-decoration: underline;">$1</span>'
    ];

    // Perform the actual conversion
    for (var i =0;i<format_search.length;i++) {
    str = str.replace(format_search[i], format_replace[i]);
    }

    return str
}
