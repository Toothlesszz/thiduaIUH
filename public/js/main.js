function swalAlert() {
    return swal.fire({
        title: "Xóa?",
        icon: 'question',
        text: "Hãy đảm bảo và xác nhận việc xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete!",
        cancelButtonColor: "#d33",
        reverseButtons: !0
    });
}

// ------------------DELETE_DEPARTMENT----------------------
function deleteDepart(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "department/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_USER---------------------
function deleteUser(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "user/delete/" + _id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_YEARS----------------------
function deleteYear(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "year/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_STYLIZED----------------------
function deleteStyli(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "stylized/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_COMPETE----------------------
function deleteCompete(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "compete/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_SEND_STYLIZED----------------------
function deleteSendStyli(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "send-stylized/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_USER_ADMIN_DEPARTMENT----------------------
function deleteUserDepart(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "user-department/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_STYLIZED_ADMIN_DEPARTMENT----------------------
function deleteDepartStylized(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "stylized-department/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_CRITERIAS----------------------
function deleteCriter(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "criterias/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// ------------------DELETE_CRITERIAS_DETAILS----------------------
function deleteCriterdetail(id) {
    swalAlert().then(function(e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: "criterias-detail/delete/" + id,
                data: { _token: CSRF_TOKEN },
                dataType: 'JSON',
                success: function(results) {
                    if (results.success === true) {
                        swal.fire("Done!", results.message, "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

// Lock, unlock stylized confirm
function confirmLockStylized(id, status) {
    swal.fire({
        title: "Bạn có chắc muốn khóa danh hiệu này không?",
        icon: 'question',
        text: "Hãy đảm bảo và xác nhận việc khóa!",
        showCancelButton: true,
        confirmButtonText: "Đồng ý khóa",
        cancelButtonColor: "#d33",
        reverseButtons: !0
    }).then(function(e) {
        if (e.value === true) {
            $.ajax({
                type: 'GET',
                url: `stylized/update-status/${id}/status/${status}`,
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        swal.fire("Thành công !", "Danh hiệu đã bị khóa !", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}

function confirmUnlockStylized(id, status) {
    swal.fire({
        title: "Bạn có chắc muốn mở khóa danh hiệu này không?",
        icon: 'question',
        text: "Hãy đảm bảo và xác nhận việc mở khóa!",
        showCancelButton: true,
        confirmButtonText: "Yes, open",
        cancelButtonColor: "#d33",
        reverseButtons: !0
    }).then(function(e) {
        if (e.value === true) {
            $.ajax({
                type: 'GET',
                url: `stylized/update-status/${id}/status/${status}`,
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        swal.fire("Thành công !", "Danh hiệu đã được mở khóa !", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                }
            });
        } else {
            e.dismiss;
        }
    }, function(dismiss) {
        return false;
    })
}