//Validate phone
function checkPhoneNumber(phone) {
    var phoneReg = /^(032|033|034|035|036|037|038|039|086|096|097|098|081|082|083|084|085|088|087|091|094|056|058|092|070|076|077|078|079|089|090|093|099|059)[0-9]{7}$/;
    return phoneReg.test(phone);
}
// is date
function isValidDateFormat(dateString) {
    // Kiểm tra xem đầu vào có phải định dạng dd/mm/yyyy không
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; // Kiểm tra định dạng dd/mm/yyyy
    return dateString.match(rxDatePattern) != null;
}
// convert date
function convertToDDMMYYYY(dateString) {
    // Kiểm tra nếu đầu vào là định dạng yyyy-mm-dd hoặc yyyy-dd-mm
    var dateParts;
    if (dateString.includes('-')) {
        // Trường hợp đầu vào là yyyy-mm-dd
        dateParts = dateString.split('-');
        // Chuyển sang định dạng dd/mm/yyyy
        return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
    } else if (isValidDateFormat(dateString)) {
        // Trường hợp đầu vào đã có định dạng dd/mm/yyyy
        return dateString;
    } else {
        return null; // Nếu không phải định dạng hợp lệ
    }
}
// Check ngày sinh
function checkBirth(dateString) {
    console.log(dateString);
    // Chuyển đổi đầu vào về định dạng dd/mm/yyyy nếu cần thiết
    var currVal = convertToDDMMYYYY(dateString);
    console.log(currVal);
    if (!currVal) {
        return false; // Đầu vào không hợp lệ
    }

    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; // Kiểm tra định dạng dd/mm/yyyy
    var dtArray = currVal.match(rxDatePattern);

    if (dtArray == null)
        return false;

    dtDay = dtArray[1];
    dtMonth = dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2) {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }

    var today = new Date();
    var year_h = today.getFullYear();
    if ((Number(year_h) - Number(dtYear)) <= 6 || (Number(year_h) - Number(dtYear)) >= 80) {
        return false;
    }

    return true;
}
//validate password 6 ký tự, 1 chữ cái, 1 số, không có khoảng trắng
function checkPassWord(password) {
    var passReg = /^(?=.*\d)(?=.*[a-zA-Z])(?=\S+$).{6,}$/;
    return passReg.test(password);
}
// Validate Email
function checkEmailAddress(email) {
    var emailReg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailReg.test(email);
}
//Check ký tự đặc biệt
function checkKTDB(str) {
    // Biểu thức chính quy để kiểm tra ký tự đặc biệt, cho phép các ký tự có dấu (unicode)
    var regex = /[^a-zA-Z0-9À-ỹ\s]/;  // Cho phép chữ cái (a-z, A-Z), số (0-9), dấu cách và các ký tự có dấu
    return !regex.test(str); // Trả về true nếu không có ký tự đặc biệt, false nếu có
}
// format tiền
function format_money(number, decimals = 2, dec_point = '.', thousands_sep = ',') {
    if (isNaN(number) || number == null) return '0';

    number = parseFloat(number).toFixed(decimals);

    let parts = number.split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

    return parts.join(dec_point);
}

function escapeHtml(text) {
    let div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
}

function nl2br(text) {
    return text.replace(/\n/g, "<br>");
}

function getUrlImageAvatar(timeStamp) {
    let dateObj = new Date(timeStamp * 1000); // Chuyển từ timestamp (giây) sang milliseconds
    let year = dateObj.getFullYear();
    let month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0 nên +1
    let day = String(dateObj.getDate()).padStart(2, '0'); // Định dạng 2 chữ số

    let dir = `pictures/${year}/${month}/${day}/`; // Full Path
    return dir;
}

function timeAgo(timestamp) {
    const now = Math.floor(Date.now() / 1000); // Lấy thời gian hiện tại dưới dạng timestamp (giây)
    const secondsAgo = now - timestamp;
    if (secondsAgo < 60) {
        return `${secondsAgo} giây trước`;
    } else if (secondsAgo < 3600) {
        const minutesAgo = Math.floor(secondsAgo / 60);
        return `${minutesAgo} phút trước`;
    } else if (secondsAgo < 86400) {
        const hoursAgo = Math.floor(secondsAgo / 3600);
        return `${hoursAgo} giờ trước`;
    } else if (secondsAgo < 604800) {
        const daysAgo = Math.floor(secondsAgo / 86400);
        return `${daysAgo} ngày trước`;
    } else if (secondsAgo < 2592000) {
        const weeksAgo = Math.floor(secondsAgo / 604800);
        return `${weeksAgo} tuần trước`;
    } else if (secondsAgo < 31536000) {
        const monthsAgo = Math.floor(secondsAgo / 2592000);
        return `${monthsAgo} tháng trước`;
    } else {
        const yearsAgo = Math.floor(secondsAgo / 31536000);
        return `${yearsAgo} năm trước`;
    }
}