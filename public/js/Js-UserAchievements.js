const openPopup = document.querySelectorAll("#btn-ViewCertification");
const closePopup = document.querySelectorAll("#closePopup");
const popupContainer = document.querySelectorAll(".popupCertification");
const DownloadCertification = document.querySelectorAll(
    "#btn-DownloadCertification"
);

openPopup.forEach(function(btn) {
    btn.addEventListener("click", function() {
        const popupContainer = btn.parentElement.querySelector(
            ".popupCertification"
        );
        popupContainer.style.display = "block";
    });
});

closePopup.forEach(function(btn) {
    btn.addEventListener("click", function() {
        const popupContainer = btn.closest(".popupCertification");
        popupContainer.style.display = "none";
    });
});

DownloadCertification.forEach(function(btn) {
    btn.addEventListener("click", function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const content = btn
            .closest(".popupCertification__content")
            .querySelector(".popupCertification__content--Certification");
        window.devicePixelRatio = 4;
        var pdfWidth = doc.internal.pageSize.getWidth();
        var pdfHeight = doc.internal.pageSize.getHeight();
        html2canvas(content).then((canvas) => {
            doc.addImage(
                canvas.toDataURL("image/png"),
                "PNG",
                0,
                0,
                pdfWidth,
                pdfHeight
            );
            doc.save("[IUH]ChungNhan.pdf");
        });
    });
});