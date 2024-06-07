const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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

$('#SAPSelectionType li').click(function () {
    $('#showImg').attr('disabled', true).removeClass('d-none');
    $('#circleSelect').val('default').selectpicker('refresh');
    $('#citySelect, #sectorSelect').html('').selectpicker('refresh');
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
                $('#pathVal, #pathVal1').attr('value', $('#circleSelect').val() + '/' + $('#citySelect').val() + '/' + e.target.value);
                // document.getElementById('pathVal').setAttribute('value', $('#circleSelect').val() + '/' + $('#citySelect').val() + '/' + e.target.value);
                // $("#imgContainer").load(" #imgContainer>*");
            }
        }
    });
});

$('#showImg').click(function () {
    $("#imgForm").submit();
});

var chk = document.getElementsByName('imgSelect[]');
document.getElementById('chkboxToggle').addEventListener('click', () => {
    $('.form-check-input').toggle();
    $('#selectAll').toggle();
    $('#deleteBtnLink').toggle();

    chk.forEach((chk) => {
        chk.checked = false;
    });
    $('#chkboxToggle').find('.↔').toggleClass('bi-box-arrow-right bi-box-arrow-in-left');
    document.getElementById('selectAll').classList.replace('btn-outline-warning', 'btn-outline-success');
    document.getElementById('selectAll').firstChild.classList.replace('bi-x-square-fill', 'bi-check-square-fill');
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
    $('.form-check-input').each(function () {
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
        document.getElementById('searchBox').focus()
    }
})

var imgDetails = document.querySelectorAll('.card');
var cnt = chk.length;
['keyup', 'click', 'input'].forEach(function (e) {
    document.getElementById('searchBox').addEventListener(e, (e) => {
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
    });
});
document.getElementById('imgCount').innerText = cnt;
$('#imgCount').text() == '0' ? $('#imgCount').addClass('text-danger') : $('#imgCount').removeClass('text-danger');

$('#searchSAP input').on("keyup input", function () {
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
$(document).on("click", "#searchRes li", function () {
    $('#searchSAP input').val($(this).text());
    $('#searchRes').empty();
    $('#searchRes').removeClass('show');
});