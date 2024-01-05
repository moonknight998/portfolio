var loadFile = function(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function() {
    URL.revokeObjectURL(preview.src) // free memory
    }
};

var openTabMultiple = function(event, tabId){
    let i, tabcontents, navlinks;

    tabcontents = document.getElementsByClassName("tab-content");

    for(i = 0; i < tabcontents.length; i++)
    {
        tabcontents[i].style.display = "none";
    }

    navlinks = document.getElementsByClassName("nav-link");

    for(i = 0; i < navlinks.length; i++)
    {
        navlinks[i].className = navlinks[i].className.replace("active", "");
    }

    document.getElementById(tabId).style.display = "block";
    event.target.className += " active";
};

var openTab = function(event, activeId, disableId){
    let i, tabcontents, navlinks;

    tabcontents = document.getElementsByClassName("tab-content");

    for(i = 0; i < tabcontents.length; i++)
    {
        if(!tabcontents[i].className.includes('custom'))
        {
            tabcontents[i].style.display = "none";
        }
    }

    navlinkDisable = document.getElementById(disableId);
    navlinkDisable.className = navlinkDisable.className.replace("active", "");
    // for(i = 0; i < navlinks.length; i++)
    // {
    //     navlinks[i].className = navlinks[i].className.replace("active", "");
    // }

    document.getElementById(activeId).style.display = "block";
    document.getElementById(activeId).className += " active";
};

var loadDocument = function(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.innerHTML = event.target.value;
};

var changeAttribute = function(event, previewId, attributeName)
{
    var preview = document.getElementById(previewId);
    preview.setAttribute(attributeName, event.target.value);
};

var changeColor = function(event, previewId)
{
    document.getElementById(previewId).style.color = event.target.value;
};

var detectEnterline = function(event, detectId)
{
    var detectElement = document.getElementById(detectId);
    if (event.keyCode == 13) {
        event.preventDefault();
        detectElement.value = detectElement.value.substring(0, detectElement.selectionStart) + "<br>" + detectElement.value.substring(detectElement.selectionEnd, detectElement.value.length);
    }
};

var changeStatus = function(event, id, className)
{
    let i, elements;

    var statusElement = document.getElementById(id);

    elements = document.getElementsByClassName(className);

    if(statusElement.value == 1)
    {
        for(i = 0; i < elements.length; i++)
        {
            if(elements[i].className.includes('di-block'))
            {
                elements[i].style.display = "block";
            }
            else
            {
                elements[i].style.display = "flex";
            }
        }
    }
    else
    {
        for(i = 0; i < elements.length; i++)
        {
            elements[i].style.display = "none";
        }
    }

}


var changeColumnSize = function(event, statusId, className)
{
    let i, elements;

    var statusElement = document.getElementById(statusId);

    elements = document.getElementsByClassName(className);

    if(statusElement.value == 1)
    {
        for(i = 0; i < elements.length; i++)
        {
            elements[i].className = elements[i].className.replace("col", "col-lg-6");
        }
    }
    else
    {
        for(i = 0; i < elements.length; i++)
        {
            elements[i].className = elements[i].className.replace("col-lg-6", "col");
        }
    }
}