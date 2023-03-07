<?php require APPROOT . 'views/inc/header.php'; ?>

<div class="modal text-dark" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <input id="_method" type="hidden" name="_method" value="">
                    <input id="uid" type="hidden" name="uid" value="">
                    <div class="row my-2">
                        <div class="col-md-auto">帳號</div>
                        <div class="col-md-10"><input class="form-control" type="text" name="account" required> </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-auto">姓名</div>
                        <div class="col-md-10"><input class="form-control" type="text" name="user_name" required> </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-auto">性別</div>
                        <div class="col-md-10">
                            <input class="form-radio" type="radio" name="gender" value="0" required> 男
                            <input class="form-radio" type="radio" name="gender" value="1" required> 女
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-auto">生日</div>
                        <div class="col-md-10"><input class="form-control" type="date" name="birth" required> </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-auto">信箱</div>
                        <div class="col-md-10"><input class="form-control" type="email" name="email" required> </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-auto">備註</div>
                        <div class="col-md-10"><textarea class="form-control" name="remark" rows="3"></textarea> </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="sub_btn" type="submit" class="btn btn-primary">確認</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">關閉</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-auto my-1">
        <button class="btn btn-primary modal_btn" data-method="POST">新增</button>
    </div>
    <div class="col-auto my-1">
        <button class="btn btn-primary modal_btn" data-method="UPDATE">編輯</button>
    </div>
    <div class="col-auto my-1">
        <button class="btn btn-primary" id="del_modal">刪除</button>
    </div>
</div>

<hr class="bg-light">
<div id="ShowData">
    <div class="row">
        <div class="col-auto">Search</div>
        <div class="col-10"><input id="search" class="form-control" type="text"></div>
    </div>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th><input id="AllCheck" type="checkbox"> </th>
                    <th>帳號</th>
                    <th>姓名</th>
                    <th>性別</th>
                    <th>生日</th>
                    <th>信箱</th>
                    <th>備註</th>
                </tr>
            </thead>
            <tbody id="tb_data">

            </tbody>
        </table>

    </div>

    <div class="row justify-content-between">
        <div id="count" class="col-md-auto my-1">數量</div>
        <div class="col-md-auto my-1">
            <div id="page" class="btn-group">

            </div>
        </div>
    </div>
</div>

<?php require APPROOT . 'views/inc/footer.php'; ?>

<script>
    //#region modal control
    let url = "/training/M2/Account_Info/";

    $(".modal_btn").on('click', function() {
        $('#_method').val($(this).data('method'));
        $('.modal-title').html($(this).html());

        if ($(this).data('method') == "POST") {
            $("#uid").val('');
            $('form input').each(function() {
                $(this).attr('required', true);
            })
        } else {
            if ($('#tb_data input[type="checkbox"]:checked').length == 0) return alert("請勾選要修改的資料");
            let temp = new Array;
            $('#tb_data input[type="checkbox"]:checked').each(function() {
                temp.push($(this).val());
            })
            $("#uid").val(temp.join(','));
            $('form input').each(function() {
                $(this).attr('required', false);
            })
        }

        $('.modal').modal('show');
    })

    $("#del_modal").on('click', function() {
        if ($('#tb_data input[type="checkbox"]:checked').length == 0) return alert("請勾選要刪除的資料");
        let del = confirm('確認要刪除?');
        if (del) {
            let temp = new Array;
            $('#tb_data input[type="checkbox"]:checked').each(function() {
                temp.push($(this).val());
            })

            let data = {
                uid: temp,
                _method: 'DELETE'
            };

            $.post(url, data, (res) => {
                if (res.res == true) {
                    ShowData()
                    alert('操作成功');
                } else {
                    alert(res.res)
                }
            }, 'json');
        }
    })

    //#endregion

    $('#sub_btn').on('click', function(event) {
        var valid = this.form.checkValidity();

        if (valid) {
            event.preventDefault();
            let data = $(this.form).serialize();
            $.post(url, data, (res) => {
                if (res.res == true) {
                    ShowData()
                    alert('操作成功');
                } else {
                    alert(res.res)
                }
                $(".modal").modal('hide');
                $(".modal form").get(0).reset();
            }, 'json');
        }
    })

    $('#AllCheck').on('click', function() {
        if ($(this).prop('checked')) {
            $(`#tb_data input[type='checkbox']`).each(function() {
                $(this).prop('checked', true);
            })
        } else {
            $(`#tb_data input[type='checkbox']`).each(function() {
                $(this).prop('checked', false);
            })
        }
    })

    $('#search').on('keyup', function() {
        let data = {
            search: this.value
        }
        ShowData(data)
    })



    ShowData()

    function ShowData(data = '') {
        $.post(url, data, (res) => {
            $('#tb_data').html('')
            res.data.forEach(e => {
                $('#tb_data').append(`
                        <tr>
                        <td><input type="checkbox" name="uid[]" value="${e.id}"></td>
                        <td>${e.account}</td>
                        <td>${e.user_name}</td>
                        <td>${e.gender}</td>
                        <td>${e.birth}</td>
                        <td>${e.email}</td>
                        <td>${e.remark}</td>
                        </tr>
                `)
            });
            $("#count").html(`顯示：${res.PageDataCount} 總筆數：${res.total}`)
            PageDom(res)
        }, 'json');
    }

    function PageDom(res) {
        $("#page").html('')
        $("#page").append(`<button class="btn btn-outline-light ${res.ThisPage==1?'disabled':''}" data-page="-1">上一頁</button>`);
        for (let i = 1; i <= res.AllPage; i++) {
            $("#page").append(`<button class="btn btn-outline-light ${i==res.ThisPage?'active':''}" data-page="${i}">${i}</button>`);
        }
        $("#page").append(`<button class="btn btn-outline-light ${res.ThisPage==res.AllPage?'disabled':''}" data-page="+1">下一頁</button>`);

        $('#page button').on('click', function() {
            let NewPage, OldPage = $('#page button.active').data('page');
            switch ($(this).data('page').toString()) {
                case '+1':
                    NewPage = OldPage + 1;
                    break;
                case '-1':
                    NewPage = OldPage - 1;
                    break;
                default:
                    NewPage = $(this).data('page');
                    break;
            }
            let data = {
                search: $('#search').val() ? $('#search').val() : null,
                page: NewPage
            }
            ShowData(data)
        })
    }
</script>