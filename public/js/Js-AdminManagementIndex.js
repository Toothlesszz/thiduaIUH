// Lấy tham chiếu đến thẻ canvas
var ctx = document.getElementById("mixedChart").getContext("2d");
const inputString = document.querySelector("#inputString").value;

// Bước 1: Tách chuỗi thành các mảng con dựa trên dấu chấm phẩy (;)
const sections = inputString.split(";");

// Bước 2: Tạo mảng cho tên khoa, điểm 1 và điểm 2
const departmentNames = [];
const points1 = [];
const points2 = [];

// Bước 3: Duyệt qua mảng con và tách thông tin
sections.forEach((section) => {
    const sectionParts = section.split(":");
    if (sectionParts.length === 2) {
        const [department, points] = sectionParts;

        if (department !== "Đoàn Trường") {
            departmentNames.push(department);

            const pointValues = points.split(",");
            if (pointValues.length === 2) {
                const [point1, point2] = pointValues;
                points1.push(point1);
                points2.push(point2);
            }
        }
    }
});

console.log(departmentNames);
console.log(points1);
console.log(points2);

// Dữ liệu biểu đồ
var data = {
    labels: departmentNames,
    datasets: [{
            label: "ỨNG VIÊN ĐẠT DANH HIỆU",
            type: "bar",
            data: points2,
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
        },
        {
            label: "SỐ LƯỢNG HỒ SƠ",
            type: "line",
            data: points1,
            fill: false,
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 2,
        },
    ],
};

// Tạo biểu đồ kết hợp nhiều loại
var mixedChart = new Chart(ctx, {
    type: "bar",
    data: data,
    options: {
        scales: {
            x: {
                grid: {
                    display: false,
                },
            },
            y: {
                grid: {
                    display: false,
                },
            },
        },
        barPercentage: 0.5,
    },
});