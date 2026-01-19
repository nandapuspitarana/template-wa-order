(function () {
    var fileFrame;

    function resetIndex() {
        var items = document.querySelectorAll('#waorder-gallery-metabox-list li');
        for (var i = 0; i < items.length; i++) {
            var input = items[i].querySelector('input[type="hidden"]');
            if (input) input.name = 'waorder_gallery_ids[' + i + ']';
        }
    }

    function appendAttachment(list, attachment, index) {
        var url = attachment.url;
        if (attachment.sizes && attachment.sizes.thumbnail && attachment.sizes.thumbnail.url) {
            url = attachment.sizes.thumbnail.url;
        }

        var li = document.createElement('li');
        li.innerHTML =
            '<input type="hidden" name="waorder_gallery_ids[' +
            index +
            ']" value="' +
            attachment.id +
            '">' +
            '<img class="image-preview" src="' +
            url +
            '">' +
            '<div class="remove-image"><span class="dashicons dashicons-trash"></span></div>';
        list.appendChild(li);
    }

    document.addEventListener('click', function (e) {
        var addBtn = e.target.closest('.waorder a.gallery-add');
        if (addBtn) {
            e.preventDefault();

            if (fileFrame) fileFrame.close();

            fileFrame = wp.media.frames.file_frame = wp.media({
                title: addBtn.getAttribute('data-uploader-title') || '',
                button: {
                    text: addBtn.getAttribute('data-uploader-button-text') || '',
                },
                multiple: true,
            });

            fileFrame.on('select', function () {
                var list = document.getElementById('waorder-gallery-metabox-list');
                if (!list) return;

                var listIndex = list.querySelectorAll('li').length - 1;
                var selection = fileFrame.state().get('selection');
                var i = 0;

                selection.each(function (attachment) {
                    var data = attachment.toJSON();
                    var index = listIndex + (i + 1);
                    appendAttachment(list, data, index);
                    i++;
                });

                resetIndex();
            });

            fileFrame.open();
            return;
        }

        var removeBtn = e.target.closest('.waorder .remove-image');
        if (removeBtn) {
            e.preventDefault();
            var li = removeBtn.closest('li');
            if (li && li.parentNode) {
                li.parentNode.removeChild(li);
                resetIndex();
            }
        }
    });

    document.addEventListener('change', function (e) {
        if (!e.target || !e.target.classList.contains('rajaongkirtype')) return;

        var val = e.target.value;
        var basics = document.querySelectorAll('.basic');
        var pros = document.querySelectorAll('.pro');

        function setCheckedDisabled(nodes, checked, disabled) {
            for (var i = 0; i < nodes.length; i++) {
                if (typeof checked === 'boolean') nodes[i].checked = checked;
                nodes[i].disabled = disabled;
            }
        }

        if (val === 'starter') {
            setCheckedDisabled(basics, false, true);
            setCheckedDisabled(pros, false, true);
        } else if (val === 'basic') {
            setCheckedDisabled(basics, null, false);
            setCheckedDisabled(pros, false, true);
        } else {
            setCheckedDisabled(basics, null, false);
            setCheckedDisabled(pros, null, false);
        }
    });
})();

function customerFollowUp(nomor){

    let wa = 'https://web.whatsapp.com/send';

	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        wa = 'whatsapp://send';
	}

    let url = wa + '?phone=' + nomor;

    let w = 960,h = 540,left = Number((screen.width / 2) - (w / 2)),top = Number((screen.height / 2) - (h / 2)),popupWindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=1, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    popupWindow.focus();
    return false;
}

var metaImageFrame;
function waorderMediaOpen(ini){

    let selector = ini.getAttribute('selector'),
    preview = ini.getAttribute('preview');

    // Sets up the media library frame
    metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
        title: ini.getAttribute('data-uploader-title'),
        button: {
            text:  ini.getAttribute('data-uploader-button-text'),
        },
    });

    // Runs when an image is selected.
    metaImageFrame.on('select', function() {

        // Grabs the attachment selection and creates a JSON representation of the model.
        var media_attachment = metaImageFrame.state().get('selection').first().toJSON();

        // Sends the attachment URL to our custom image input field.
        var input = document.querySelector(selector);
        if (input) input.value = media_attachment.url;
        var img = document.querySelector(preview);
        if (img) img.setAttribute('src', media_attachment.url);

    });

    // Opens the media library frame.
    metaImageFrame.open();
}

function waorderDynamicInputAdd(ini, id){

    let fields = ini.getAttribute('data-fields');
    console.log(fields);

    let box = document.getElementById(id);
    // let inputbox = box.firstElementChild.cloneNode(true);
    // let inputs = inputbox.querySelectorAll('input');
    // for (var i = 0; i < inputs.length; i++) {
    //     inputs[i].value = '';
    // }
    let div = document.createElement('div');
    div.className = 'customvariablefieldbox';
    div.innerHTML = fields;
    box.appendChild(div);
}

function waorderDynamicInputDelete(ini){

    let inputbox = ini.parentNode;
    inputbox.parentNode.removeChild(inputbox);

}


function waorderOpenTab(evt, targetID) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(targetID).style.display = "block";
    evt.currentTarget.className += " active";
}
