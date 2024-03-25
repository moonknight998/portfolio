var loadFile = function(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function() {
        URL.revokeObjectURL(preview.src) // free memory
    }
};

// Get the file upload field element
var fileUploadField = document.getElementById("file-upload");

// Add event listener for when the file selection changes
if (fileUploadField)
{
    fileUploadField.onchange = function() {
        // Get the maximum file size from the file upload field attribute
        var maxSize = fileUploadField.getAttribute("max-size");
        // Get the ID of the preview element from the file upload field
        // attribute. This ID is used to set the src attribute of the preview
        // element to display the selected file
        var previewId = fileUploadField.getAttribute("preview-id"); // preview-id
        // Check if the size of the selected file exceeds the maximum size
        if (this.files[0].size > maxSize) {
            // Alert the user with an error message including the maximum size in bytes
            alert(fileUploadField.getAttribute("max-size-error") + formatBytes(maxSize) + ".");
            // Clear the file selection
            this.value = "";
        } else {
            if(previewId)
            {
                loadFile(event, previewId);
            }
        }
    }
}

/**
 * Format the given number of bytes into a human-readable string representation.
 * @param {number} bytes - The number of bytes to format.
 * @param {number} decimals - The number of decimal places to round the result to. Default is 2.
 * @returns {string} - The formatted string representing the size in bytes, KiB, MiB, GiB, etc.
 */
function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

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

var expandable = function(event, expandContentId)
{
    saveEventTargetClassName = event.target.className;
    saveExpandContentIdClassName = document.getElementById(expandContentId).className;

    accordionButtons = document.getElementsByClassName("accordion-button");

    for(i = 0; i < accordionButtons.length; i++)
    {
        if(!accordionButtons[i].className.includes('collapsed'))
        {
            accordionButtons[i].className = accordionButtons[i].className + " collapsed";
        }
    }

    accordionCollapses = document.getElementsByClassName("accordion-collapse collapse");

    for (i = 0; i < accordionCollapses.length; i++)
    {
        if (accordionCollapses[i].className.includes('show'))
        {
            accordionCollapses[i].className = accordionCollapses[i].className.replace(" show", "");
        }
    }

    if(saveEventTargetClassName.includes('collapsed'))
    {
        //event.target.className = event.target.className + " collapsed";
        event.target.className = event.target.className.replace(" collapsed", "");
    }

    if(!saveExpandContentIdClassName.includes('show'))
    {
        document.getElementById(expandContentId).className = document.getElementById(expandContentId).className + " show";
    }
}

var loadDocument = function(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.innerHTML = event.target.value;
};

var loadDocumentOption = function(event, previewId) {
    var preview = document.getElementById(previewId);
    preview.innerHTML = event.target.options[event.target.selectedIndex].text;
};

var changeAttribute = function(event, previewId, attributeName)
{
    var preview = document.getElementById(previewId);
    preview.setAttribute(attributeName, event.target.value);
};

var changeClassWithExtraParam = function(event, previewId, extraParam)
{
    var preview = document.getElementById(previewId);
    preview.setAttribute('class', event.target.value + ' ' + extraParam);
};

var changeColor = function(event, previewId)
{
    document.getElementById(previewId).style.color = event.target.value;
};

var changeColorWithColorName = function(event, previewId, colorName)
{
    document.getElementById(previewId).style.color = colorName;
};

var changeColorByInput = function(event, id, colorId)
{
    document.getElementById(id).style.color = document.getElementById(colorId).value;
}

var changeBackgroundByColorCode = function(event, id, colorCode)
{
    document.getElementById(id).style.background = colorCode;
}

var changeBackground = function(event, previewId)
{
    document.getElementById(previewId).style.background = event.target.value;
};

var changeStyle = function(event, previewId, styleToChange)
{
    document.getElementById(previewId).style.borderBottomColor = event.target.value;
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
var changeStatusOne = function(event, id, idToChange)
{

    var statusElement = document.getElementById(id);

    elementToChange = document.getElementById(idToChange);

    if(statusElement.value == 1)
    {
        elementToChange.style.display = "block";
    }
    else
    {
        elementToChange.style.display = "none";
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

var changeBackgroundByInput = function(event, id, colorId)
{
    document.getElementById(id).style.background = document.getElementById(colorId).value;
}

var changeBackgroundToWhite = function(event, id)
{
    document.getElementById(id).style.background = 'white';
}

var changeBackgroundWithColorName = function(event, previewId, colorName)
{
    document.getElementById(previewId).style.color = colorName;
};


window.addEventListener('DOMContentLoaded', () => {
    //For created successfully
    let toastcreated = document.getElementById('toast-created');
    if (toastcreated)
    {
        let toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastcreated);
        toastBootstrap.show();
    }
    //For updated successfully
    let toastupdated = document.getElementById('toast-updated');
    if (toastupdated)
    {
        let toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastupdated);
        toastBootstrap.show();
    }
    //Get input form
    var dataform = document.getElementById('data-form');
    let toastfailed = document.getElementById('toast-failed');
    if (dataform) {
        dataform.addEventListener('submit', function (e) {
        if(!dataform.checkValidity())
        {
            e.preventDefault();
            if (toastfailed) {
            let toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastfailed);
            toastBootstrap.show();
            }
        }
        })
    }
})
