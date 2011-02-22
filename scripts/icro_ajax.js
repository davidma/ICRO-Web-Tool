// Toggles a div state (collapsed or not)
function toggleDiv(name,imgid)
{
    if (document.getElementById(name).style.display == 'block' || document.getElementById(name).style.display == '')
    {
        document.getElementById(name).style.display = 'none';
        document.getElementById(imgid).innerHTML = '[+]';
    }
    else
    {
        document.getElementById(name).style.display = 'block';
        document.getElementById(imgid).innerHTML = '[-]';
    }
}
