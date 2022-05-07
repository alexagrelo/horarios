let data = [];

function addNewInput(subject, teacher, weeklyHours) {
    // console.log('addNewInput');
    let newInput = {
        subject: subject,
        teacher: teacher,
        weeklyHours: weeklyHours
    }
    data.push(newInput);
    console.log('data: ', data);

    sessionStorage.setItem('data', JSON.stringify(data));
}

function paintTable() {
    // console.log('paintTable');
    table = document.getElementById("dataTable");
    tbody = document.querySelector("#dataTable tbody");
    tbody.innerHTML = "";
    for (let i = 0; i < data.length; i++) {
        let row = table.insertRow(i);
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        cell1.innerHTML = data[i].subject;
        cell2.innerHTML = data[i].teacher;
        cell3.innerHTML = data[i].weeklyHours;

        tbody.appendChild(row);
    }
}

function saveData(e) {
    // console.log('saveData');
    e.preventDefault();
    let subject = document.getElementById("inputSubject").value;
    let teacher = document.getElementById("inputTeacher").value;
    let weeklyHours = document.getElementById("inputWeeklyHours").value;
    addNewInput(subject, teacher, weeklyHours);
    paintTable();
}

function reqListener() {
    console.log(this.responseText);
}

document.getElementById("btnSubmit").addEventListener("click", saveData);
paintTable();

