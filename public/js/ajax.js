//Show competeShow
$(function () {
    $(document).on('click', '.viewBtn', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "compete/show"+"/"+id,
            success: function (response) {
                $('#title_compete').text(response.competeShow.name);
                $('#author_compete').text(response.competeShow.author);
                $('#date_compete').text(response.competeShow.date);
                $('#summary_compete').text(response.competeShow.summary);
                $('#content_compete').text(response.competeShow.content);
            }
        });
    });
});

//Show competeShow user
$(function () {
    $(document).on('click', '.viewUserBtn', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "list-compete/show"+"/"+id,
            success: function (response) {
                $('#title_compete').text(response.competeShowUser.name);
                $('#author_compete').text(response.competeShowUser.author);
                $('#date_compete').text(response.competeShowUser.date);
                $('#summary_compete').text(response.competeShowUser.summary);
                $('#content_compete').text(response.competeShowUser.content);
            }
        });
    });
});

//Show stylizedShow user
$(function () {
    $(document).on('click', '.viewFile', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "send-stylized/show"+"/"+id,
            success: function (response) {
                $('#show_file_data').attr("src", "../uploads/stylized/" + response.registerShow.file);
            }
        });
    });
});

//Show file certification
$(function () {
    $(document).on('click', '.viewFileCertify', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "pass-certification/show"+"/"+id,
            success: function (response) {
                $('#show_file_data_certify').attr("src", "../certificate/certificate_granted/" + response.showFileCertify.image);
            }
        });
    });
});

//Show file certification
$(function () {
    $(document).on('click', '.adminViewCertifi', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "user-pass-stylized/show"+"/"+id,
            success: function (response) {
                $('#show_file_certify_admin').attr("src", "../certificate/certificate_granted/" + response.showFileCertifyAdmin.image);
            }
        });
    });
});

//Show file certification user
$(function () {
    $(document).on('click', '.clickFileCertifyUser', function() {
        var id = $(this).val();

        $.ajax({
            type: "GET",
            url: "pass-stylized/show" + "/" + id,
            success: function (response) {
                $('#show_file_data_user_certification').attr("src", "../certificate/certificate_granted/" + response.showFileCertifyUser.image);
            }
        });
    });
});

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

// Show stylized by year
$(document).ready(function (){
    $("#admin-department-stylized-year").on("change", function() {
        let value = $(this).val();

        $.ajax({
            type: "GET",
            url: `${window.location.origin}/admin-department/ajax-stylized-year/${value}`,
            success: function (response) {
                let html = '<option value="">Vui lòng chọn danh hiệu</option>';
                let stylizeds = response.data;
                for (let item of stylizeds) {
                    html += `<option value="${item.id}">${item.name_stylized}</option>`;
                }

                $("#admin-department-stylized").html(html);
            }
        });
    });

    $("#admin-stylized-year").on("change", function() {
        let value = $(this).val();

        $.ajax({
            type: "GET",
            url: `${window.location.origin}/admin/ajax-stylized-year/${value}`,
            success: function (response) {
                let html = '<option value="">Vui lòng chọn danh hiệu</option>';
                let stylizeds = response.data;
                for (let item of stylizeds) {
                    html += `<option value="${item.id}">${item.name_stylized}</option>`;
                }

                $("#admin-stylized").html(html);
            }
        });
    });
});
