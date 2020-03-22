$(function () {
    var $avatarImage, $avatarInput, $avatarForm, $avatarProfile;

    $avatarImage = $('#avatarImage');
    $avatarInput = $('#avatarInput');
    $avatarForm = $('#avatarForm');
    $avatarProfile = $('#avatarProfile');

    $avatarImage.on('click', function () {
        $avatarInput.click();
    });

    $avatarInput.on('change', function () {
        var formData = new FormData();
        formData.append('photo', $avatarInput[0].files[0]);

        if($avatarInput.val().length>1){
            $.ajax({
                url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
                method: $avatarForm.attr('method'),
                data: formData,
                processData: false,
                contentType: false
            }).done(function (data) {

                if (data.success)
                    $avatarProfile.attr('src', data.url);
            }).fail(function () {
                alert('La imagen subida no tiene un formato correcto');
            });
        }

    });
});
