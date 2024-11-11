function signUp() {

    var f = document.getElementById("fname").value;
    var l = document.getElementById("lname").value;
    var e = document.getElementById("email").value;
    var p = document.getElementById("password").value;
    var rep = document.getElementById("repassword").value;
    var g = document.getElementById("gender").value;
    var a = document.getElementById("agreeTerms").checked;

    var form = new FormData();
    form.append("f", f);
    form.append("l", l);
    form.append("e", e);
    form.append("p", p);
    form.append("rep", rep);
    form.append("a", a);
    form.append("g", g);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success!") {

                f = "";
                l = "";
                e = "";
                p = "";
                rep = "";

                $(function() {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: text
                    })

                });

            } else {
                $(function() {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: text
                    })

                });
            }



        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(form);

}

function signIn() {

    var email = document.getElementById("e").value;
    var password = document.getElementById("pw").value;
    var rememberme = document.getElementById("remember").checked;


    var form = new FormData();
    form.append("e", email);
    form.append("p", password);
    form.append("rm", rememberme);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                $(function() {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'warning',
                        title: t
                    })

                });
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(form);
}

var bm;

function forgotPassword() {
    // alert("ok");
    var email = document.getElementById("e").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;



            if (t == "Success") {
                title = "Verification code has send to your email. please check inbox.";
                icon = "success";

                notify();

                // var Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     showConfirmButton: false,
                //     timer: 3000
                // });
                // Toast.fire({
                //     icon: icon,
                //     title: title
                // })

                // alert(title);

                var m = document.getElementById("fogotPasswordModel");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                title = t;
                icon = "warning";
                notify();
            }



        }
    }
    r.open("GET", "forgotPasswordProcess.php?e=" + email, true);
    r.send();
}





function showpassword1() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = "<i class='bi bi-eye-slash-fill'>Hide</i>";
    } else {
        np.type = "password";
        npb.innerHTML = "<i class='bi bi-eye-slash-fill'>Show</i>";
    }
}

function showpassword2() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = "<i class='bi bi-eye-slash-fill'>Hide</i>";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "<i class='bi bi-eye-slash-fill'>Show</i>";
    }
}

function resetpassword() {

    var e = document.getElementById("e");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                title = 'Password reset success.';
                icon = "success";
                notify();

            } else {

                title = t;
                icon = "warning";
                notify();
            }
        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(form);
}






function basicSearch(x) {
    var text = document.getElementById("basic_search_text");
    var select = document.getElementById("basic_search_select");

    var f = new FormData();
    f.append("t", text.value);
    f.append("s", select.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
            // alert(t);
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}

function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "index.php";
            }

        }
    }

    r.open("GET", "signOutProccess.php", true);
    r.send();
}

function contactUs() {
    var name = document.getElementById("inputName").value;
    var email = document.getElementById("inputEmail").value;
    var subject = document.getElementById("inputSubject").value;
    var Msg = document.getElementById("inputMessage").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                title = t;
                icon = "success";
            } else {
                title = t;
                icon = "warning";

            }

            notify();
        }

    }

    r.open("GET", "contactUsProccess.php?n=" + name + "&e=" + email + "&s=" + subject + "&m=" + Msg, true);
    r.send();
}

var title;
var icon = "warning";

function notify() {
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: icon,
            title: title
        })

    });
}

function advancedSearch(x) {

    var search_tex = document.getElementById("s1");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m1");
    var condition = document.getElementById("con");
    var color = document.getElementById("col");
    var price_from_txt = document.getElementById("pf");
    var price_to_txt = document.getElementById("pt");
    var sort = document.getElementById("sort");

    var form = new FormData();

    form.append("page", x);
    form.append("s", search_tex.value);
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("c1", condition.value);
    form.append("c2", color.value);
    form.append("p1", price_from_txt.value);
    form.append("p2", price_to_txt.value);
    form.append("s1", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);

}

function manu(x) {
    window.location = x;
}

function loadMainImg(id) {
    // alert(id);
    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";

}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
    } else {
        title = "Maximum quantity has achieved";
        icon = "warning";
        notify();
    }
}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        title = "Minimum quantity has achieved";
        icon = "warning";
        notify();
    }
}

function buyNow(id) {
    var qty = document.getElementById("qty_input").value;
    // var unitPrice = document.getElementById("unitPrice").value;

    var f = new FormData();
    f.append("pid", id);
    f.append("pqty", qty);
    // f.append("uprice", unitPrice);

    var r = new XMLHttpRequest();


    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            window.location = "invoice.php?order_id=" + t;

            // alert(t);

        }
    }

    r.open("POST", "buyNowProcess.php?id=" + id, true);
    r.send(f);
}

function toInvoice(order_id) {
    window.location = "invoice.php?order_id=" + order_id;
}

function toDelete(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();


    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success")
                window.location = "purchasehistory.php";

            // alert(t);

        }
    }

    r.open("POST", "invoiceDeleteProcess.php", true);
    r.send(f);
}

function paynowproduct(amount, pid) {


    var title = document.getElementById("ptitle").innerHTML;
    var qty = document.getElementById("qty_input").value;
    var img = document.getElementById('productImg0').getAttribute('src');

    var t = parseInt(amount);
    var q = parseInt(qty);

    var price = t * q;

    window.location = "checkout.php?item_name=" + title + "&price=" + price + "&image=" + img + "&pid=" + pid + "&qty=" + q;

}

function addToCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            title = t;
            icon = "success";
            notify();
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function addToWatchlist(id) {
    // alert(id);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                document.getElementById("heart" + id).style.color = "white";
                window.location.reload();
            } else if (t == "Added") {
                document.getElementById("heart" + id).style.color = "red";
                window.location.reload();
            } else {
                title = t;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();
}

function printInvoice() {
    // alert("ok");

    var page = document.getElementById("page").innerHTML;
    var restorePage = document.body.innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

function changeImage() {
    var view = document.getElementById("viewimg");
    var file = document.getElementById("profileimg");

    file.onchange = function() {
        var file1 = this.files[0];
        var url1 = window.URL.createObjectURL(file1);
        view.src = url1;
    }
}

function viewpw() {
    var pwtxt = document.getElementById("pwtxt");
    var pwbtn = document.getElementById("viewpassword");

    if (pwtxt.type == "text") {
        pwtxt.type = "password";
        pwbtn.innerHTML = "<i class='bi bi-eye-fill'>";
    } else {
        pwtxt.type = "text";
        pwbtn.innerHTML = "<i class='bi bi-eye-slash-fill'>";
    }
}

function update_profile() {
    var fname = document.getElementById("fn");
    var lname = document.getElementById("ln");
    var mobile = document.getElementById("mo");
    var line1 = document.getElementById("l1");
    var line2 = document.getElementById("l2");
    var province = document.getElementById("pr");
    var district = document.getElementById("dr");
    var city = document.getElementById("ci");
    var postal_code = document.getElementById("pc");
    var image = document.getElementById("profileimg");

    var form = new FormData();
    form.append("fn", fname.value);
    form.append("ln", lname.value);
    form.append("m", mobile.value);

    form.append("li1", line1.value);
    form.append("li2", line2.value);
    form.append("pr", province.value);
    form.append("di", district.value);

    form.append("ci", city.value);
    form.append("pc", postal_code.value);

    if (image.files.length == 0) {
        var comfirmAction = confirm("Are you sure you don't want to update your profile picture?");

        if (comfirmAction) {
            alert("You  have not selected any image. ");
        } else {

        }
    } else {
        form.append("image", image.files[0]);
    }



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Log In to your account first.") {
                alert(t);
                window.location = "index.php";
            } else if (t == "Success") {
                window.location = "userprofile.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);
}

function changeInvoiceId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (r == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
            } else if (r == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
            } else if (r == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
            } else if (r == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = "disabled";
            }
            // else {
            //     alert(t);

            // }

            location.reload();



        }
    }

    r.open("GET", "changeInvoiceIdProcess.php?id=" + id, true);
    r.send();
}

function sortFunction() {
    var search = document.getElementById("s");
    var time;

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty;

    if (document.getElementById("l").checked) {
        qty = "1";
    } else if (document.getElementById("h").checked) {
        qty = "2";
    }

    var condition;

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location = "myproduct.php";
}

function changeStatus(id) {

    var product_id = id;
    var switch_btn = document.getElementById("flexSwitchCheckDefault" + id);
    var switch_lbl = document.getElementById("switchlbl" + id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactivated") {
                alert("Product has been Deactivated");
                window.location = "myproduct.php";
            } else if (t == "activated") {
                alert("Product has been Activated");
                window.location = "myproduct.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "statusChangeProcess.php?id=" + product_id, true);
    r.send();

}

function sendId(id) {


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {

                window.location = "updateproduct.php";

            } else {
                alert(t);
            }


        }
    }

    r.open("GET", "sendProductIdProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    // alert(id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "Success") {
                window.location.reload();
            } else {
                alert(text);
            }
        }
    }

    request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    request.send();
}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "Success") {
                title = "Product removed from the cart.";
                icon = "success";
                notify();
                window.location = "cart.php";
            } else {
                title = txt;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}

var add;

function hidethis() {
    add.hide();
}

function addFeedback(id) {
    var m = document.getElementById("exampleModal" + id);
    add = new bootstrap.Modal(m);
    add.show();
}

function SendFeedback(id, uid) {
    var text = document.getElementById("messagetext" + uid).value;

    var f = new FormData();
    f.append("pid", id);
    f.append("text", text);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                add.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendFeedProcess.php", true);
    r.send(f);
}

function changeProductImage() {
    var image = document.getElementById("imageuploader");


    image.onchange = function() {

        var img_count = image.files.length;

        for (var x = 0; x < img_count; x++) {
            var file = this.files[x];
            var url = window.URL.createObjectURL(file);

            document.getElementById("preview" + x).src = url;
        }


    }
}

function addproduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title1 = document.getElementById("title");

    var condition = 0;
    var bn = document.getElementById("bn");
    var us = document.getElementById("us");

    if (bn.checked) {
        condition = 1;
    } else if (us.checked) {
        condition = 2;
    }

    var color = 0;
    var clr1 = document.getElementById("clr1");
    var clr2 = document.getElementById("clr2");
    var clr3 = document.getElementById("clr3");
    var clr4 = document.getElementById("clr4");
    var clr5 = document.getElementById("clr5");
    var clr6 = document.getElementById("clr6");

    if (clr1.checked) {
        color = 1;
    } else if (clr2.checked) {
        color = 2;
    } else if (clr3.checked) {
        color = 3;
    } else if (clr4.checked) {
        color = 4;
    } else if (clr5.checked) {
        color = 5;
    } else if (clr6.checked) {
        color = 6;
    }

    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("description");
    var imageuploader = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("category", category.value);
    form.append("brand", brand.value);
    form.append("model", model.value);
    form.append("title", title1.value);
    form.append("co", condition);
    form.append("col", color);
    form.append("qty", qty.value);
    form.append("cost", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);
    form.append("imageuploader", imageuploader.files[0]);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Please Log In to your account first.") {
                title = t;
                icon = "warning";
                notify();
                window.location = "index.php";
            } else if (t == "Success") {
                window.location = "addproduct.php";
            } else {
                title = t;
                icon = "warning";
                notify();
            }
        }
    }
    r.open("POST", "addproductprocess.php", true);
    r.send(form);



}

function updateProduct() {
    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_out_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_out_colombo.value);
    f.append("d", description.value);
    f.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            title = t;
            icon = "warning";
            notify();
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);
}

function backtologin() {
    window.location = "login.php";
}

var xm;

function adminVerification() {

    var e = document.getElementById("em")

    var f = new FormData();
    f.append("em", e.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var txt = r.responseText;
            if (txt == "success") {
                var verificationModal = document.getElementById("verificationModal");
                xm = new bootstrap.Modal(verificationModal);
                xm.show();
            } else {
                title = txt;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);

}

function verify() {
    var vcode = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                xm.hide();
                window.location = "adminpanel.php";
            } else {
                title = t;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("GET", "verifyProcess.php?id=" + vcode.value, true);
    r.send();
}

var mm;

function viewMsgModal(mail) {
    var m = document.getElementById("viewmsgmodal" + mail);
    mm = new bootstrap.Modal(m);
    mm.show();
}

function userBlock(email) {

    var mail = email;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Blocked") {
                title = "User has been Blocked";
                icon = "success";
                notify();
                window.location = "manageusers.php";
            } else if (t == "Unblocked") {
                title = "User has been Unblocked";
                icon = "success";
                notify();
                window.location = "manageusers.php";
            } else {
                title = t;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("GET", "manageUserBlockProcess.php?mail=" + mail, true);
    r.send();
}

function sendMsg2(recever_mail) {
    var msg_txt = document.getElementById("msgTxt" + recever_mail);

    var f = new FormData();
    f.append("rm", recever_mail);
    f.append("mt", msg_txt.value);
    f.append("u", "a");


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php"
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

var pm;

function viewProductModal(id) {
    var m = document.getElementById("viewproductmodal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

function productBlock(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Blocked") {
                title = "Product has been Blocked";
                icon = "success";
                notify();
                window.location = "manageProduct.php";
            } else if (t == "Unblocked") {
                title = "Product has been Unblocked";
                icon = "success";
                notify();
                window.location = "manageProduct.php";
            } else {
                title = t;
                icon = "warning";
                notify();
            }

        }
    }

    r.open("GET", "manageProductBlockProcess.php?id=" + product_id, true);
    r.send();

}

var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModel");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;
var newCategory;
var uemail;

function categoryVerifyModel() {
    var m = document.getElementById("addCategoryModelVerification");
    cvm = new bootstrap.Modal(m);

    newCategory = document.getElementById("n").value;
    uemail = document.getElementById("e").value;

    var f = new FormData();
    f.append("n", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var response = r.responseText;
            if (response == "success") {
                cm.hide();
                cvm.show();
            } else {
                title = response;
                icon = "warning";
                notify();
            }

        }

    }

    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);
}

function saveCategory() {
    var text = document.getElementById("vtxt").value;

    var f = new FormData();
    f.append("t", text);
    f.append("c", newCategory);
    f.append("e", uemail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var response = r.responseText;
            // if (response == "success") {
            //     cm.hide();
            //     cvm.show();
            // } else {
            title = response;
            icon = "success";
            notify();

            if (response == "success") {
                window.location = "manageProduct.php";
            }
            // }

        }

    }
    r.open("POST", "saveNewCategoryProcess.php", true);
    r.send(f);
}

function destination(id) {
    var m = document.getElementById("exampleModal2" + id);
    add2 = new bootstrap.Modal(m);
    add2.show();
}

var add2;

function hidethis2() {
    add2.hide();
}

var stt = 1;

function IndexValue1() {
    stt = 1;
}

function IndexValue2() {
    stt = 2;
}

function viewMessages(email) {
    // alert(email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMessageProcess.php?email=" + email, true);
    r.send();
}

function viewSendMessages(email) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewSendMessageProcess.php?email=" + email, true);
    r.send();
}

function call() {
    if (stt == 1) {
        sendMsg();
    } else if (stt == 2) {
        sendboxMsg();
    }
}

function sendMsg() {
    var recever_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("rm", recever_mail.innerHTML);
    f.append("mt", msg_txt.value);
    f.append("u", "u");


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "message.php"
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

function sendboxMsg() {
    var recever_mail = document.getElementById("rmail2");
    var msg_txt = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("rm", recever_mail.innerHTML);
    f.append("mt", msg_txt.value);
    f.append("u", "u");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "message.php"
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}