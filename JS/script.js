const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, { trigger: 'hover' }));

var figs = document.getElementsByTagName('figure');
for (const fig of figs) {
    fig.style.width = window.innerHeight / 2.5 + 'px';
    fig.children[1].children[1].style.width = window.innerHeight / 3.17 + 'px';
}
window.addEventListener('resize', () => {
    for (const fig of figs) {
        fig.style.width = window.innerHeight / 2.5 + 'px';
        fig.children[1].children[1].style.width = window.innerHeight / 3.17 + 'px';
    }
});

const gallery = new Viewer(document.getElementById('imgContainer'), {
    shown() {
        document.getElementById('viewer0').addEventListener('contextmenu', (e) => {
            e.preventDefault();
        });
    }
});

$('#circleSelect, #citySelect, #sectorSelect').selectpicker('hide');

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

$(function () {
    $('[name="SAPOpt"]').click(function () {
        var This = $(this);
        var opt = This.prop('id');
        sessionStorage.setItem('opt', opt);
    });
    var optVal = sessionStorage.getItem('opt');
    if (optVal != null) {
        $('[id="' + optVal + '"]').click();
    }
});

$('#SAPSelectionType li').click(function () {
    $('#uploadGrp, #showImg').attr('disabled', true);
    $('#showImg').removeClass('d-none');
    // $('#circleSelect, #citySelect, #sectorSelect').selectpicker('val', '');
    $('#sectorSelect').selectpicker('val', '');
    $('#searchSAP input').val('');
});

$('#circleSelect').on('changed.bs.select', function (e, clickedIndex, isSelected, prevVal) {
    $.ajax({
        type: "POST",
        url: "modules/selectCity.php",
        data: { circle: e.target.value },
        success: function (data) {
            $('#uploadGrp, #showImg').attr('disabled', true);
            $('#citySelect').html(data);
            $('#sectorSelect').html('');
            $('#citySelect, #sectorSelect').selectpicker('refresh');
        }
    });
});
$('#citySelect').on('changed.bs.select', function (e, clickedIndex, isSelected, prevVal) {
    $.ajax({
        type: "POST",
        url: "modules/selectSector.php",
        data: { city: e.target.value },
        success: function (data) {
            $('#uploadGrp, #showImg').attr('disabled', true);
            $('#sectorSelect').html(data);
            $('#sectorSelect').selectpicker('refresh');
        }
        // }).done(function (data) {
        //     $('#sectorSelect').html(data);
    });
});
$('#sectorSelect').on('changed.bs.select', function (e, clickedIndex, isSelected, prevVal) {
    $.ajax({
        type: "POST",
        url: "index.php",
        success: function (data) {
            if (e.target.value == "") { $('#uploadGrp, #showImg').attr('disabled', 'true'); }
            else {
                $('#uploadGrp, #showImg').removeAttr('disabled');
                $('#pathVal, #pathVal1').attr('value', e.target.value);
                // $('#pathVal, #pathVal1').attr('value', $('#circleSelect').val() + '/' + $('#citySelect').val() + '/' + e.target.value);
                // document.getElementById('pathVal').setAttribute('value', $('#circleSelect').val() + '/' + $('#citySelect').val() + '/' + e.target.value);
                // $("#imgContainer").load(" #imgContainer>*");
            }
        }
    });
});

window.onload = async function () {
    $('#circleSelect').on('changed.bs.select', function () {
        var This = $(this);
        var sel = This.val();
        sessionStorage.setItem('circleSel', sel);
        $('#spinner div').removeClass('d-none');
        setTimeout(() => {
            $('#spinner div').addClass('d-none');
        }, 500);
    });
    var selVal = sessionStorage.getItem('circleSel');
    if (selVal != null) {
        $('#circleSelect').selectpicker('val', selVal);
    }
    await new Promise(res => setTimeout(res, 500));

    $('#citySelect').on('changed.bs.select', function () {
        var This = $(this);
        var sel = This.val();
        sessionStorage.setItem('citySel', sel);
        $('#spinner div').removeClass('d-none');
        setTimeout(() => {
            $('#spinner div').addClass('d-none');
        }, 1500);
    });
    var selVal = sessionStorage.getItem('citySel');
    if (selVal != null) {
        $('#citySelect').selectpicker('val', selVal);
    }
    await new Promise(res => setTimeout(res, 1500));

    $('#sectorSelect').on('changed.bs.select', function () {
        var This = $(this);
        var sel = This.val();
        sessionStorage.setItem('sectorSel', sel);
    });
    var selVal = sessionStorage.getItem('sectorSel');
    if (selVal != null) {
        $('#sectorSelect').selectpicker('val', selVal);
    }
}

$('#searchSAP input').on("keyup click input change", function () {
    var searchSAPVal = $(this).val();
    if (searchSAPVal.length >= $(this).attr('minlength')) {
        // $.post("modules/dbSearchSAP.php", { term: inputVal }).done(function (data) {
        //     $('#searchRes').html(data);
        // });
        $.ajax({
            type: "POST",
            url: "modules/dbSearchSAP.php",
            data: { term: searchSAPVal },
            success: function (data) {
                $('#searchRes').html(data);
                $('#searchRes').addClass('show');
            }
        });
    } else {
        $('#searchRes').empty();
        $('#searchRes').removeClass('show');
    }
});
$(document).on('click', '#searchRes li', function () {
    var SAPID = $(this).text();
    $('#searchSAP input').val(SAPID);
    $('#searchRes').empty().removeClass('show');
    $('#uploadGrp, #showImg').removeAttr('disabled');
    $('#pathVal, #pathVal1').attr('value', SAPID);
});

$(function () {
    $('#searchSAP fieldset input').on('keyup click input change', function () {
        var This = $(this);
        var sap = This.val();
        sessionStorage.setItem('sap', sap);
    });
    var sapVal = sessionStorage.getItem('sap');
    if (sapVal != null) {
        $('#searchSAP fieldset input').val(sapVal);
    }
});

$('#showImg').click(function () {
    $('#pathVal, #pathVal1').attr('value', $('#pathVal, #pathVal1').attr('value').substr(2, 2) + '/' + $('#pathVal, #pathVal1').attr('value').substr(5, 4) + '/' + $('#pathVal, #pathVal1').attr('value'));
    $('#imgForm').submit();
});

var chk = document.getElementsByName('imgSelect[]');
document.getElementById('chkboxToggle').addEventListener('click', () => {
    // $('.form-check-input').toggle();
    $('[name="imgSelect[]"]').toggle();
    $('#selectAll').toggle();
    $('#deleteBtnLink').toggle();

    chk.forEach((chk) => {
        chk.checked = false;
    });
    $('#chkboxToggle').find('.↔').toggleClass('bi-box-arrow-right bi-box-arrow-in-left');
    document.getElementById('selectAll').classList.replace('btn-outline-warning', 'btn-outline-success');
    document.getElementById('selectAll').firstElementChild.classList.replace('bi-x-square-fill', 'bi-check-square-fill');
});

$('#selectAll').click(function () {
    // chk.forEach((chk) => {
    //     if (chk.checked == false) {
    //         chk.checked = true;
    //     } else {
    //         chk.checked = false;
    //     }
    // });
    // chk.each(function () { this.checked = !this.checked; });
    var chkStat = $(this).hasClass('btn-outline-success') ? true : false;
    // $('.form-check-input').each(function () {
    $('[name="imgSelect[]"]').each(function () {
        $(this).prop('checked', chkStat);
    });
    $(this).toggleClass('btn-outline-success btn-outline-warning');
    $(this).find('i').toggleClass('bi-check-square-fill bi-x-square-fill');
});

$('#delConfirm').click(function () {
    $("#deleteBtn").click();
});

window.addEventListener("keydown", (e) => {
    if ((e.ctrlKey || e.metaKey) && e.code === 'KeyK') {
        e.preventDefault();
        document.getElementById('imgSearch').focus()
    }
})

var imgDetails = document.querySelectorAll('.card');
var cnt = chk.length;
['keyup', 'click', 'input', 'change'].forEach(function (e) {
    document.getElementById('imgSearch').addEventListener(e, (e) => {
        cnt = 0;
        imgDetails.forEach((imgDetail) => {
            if (!imgDetail.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                imgDetail.style.display = 'none';
            } else {
                imgDetail.style.display = 'inline-block';
                cnt += 1;
            }
        });
        document.getElementById('imgCount').innerText = cnt;
        $('#imgCount').text() == '0' ? $('#imgCount').addClass('text-danger') : $('#imgCount').removeClass('text-danger');
        $('#imgCount').text() == '1' ? $('#imgCntTxt').text('Image') : $('#imgCntTxt').text('Images');
    });
});
document.getElementById('imgCount').innerText = cnt;
$('#imgCount').text() == '0' ? $('#imgCount').addClass('text-danger') : $('#imgCount').removeClass('text-danger');
$('#imgCount').text() == '1' ? $('#imgCntTxt').text('Image') : $('#imgCntTxt').text('Images');

window.onscroll = function () {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $('#gotoTop').removeClass('d-none');
    } else {
        $('#gotoTop').addClass('d-none');
    }
};

$('#gotoTop').click(() => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});