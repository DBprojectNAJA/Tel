<?php 
    include "../connect/connect.php"; 
?>
<html>
    <head>
        <mega charset="utf-8">
        <script>
            async function getDataFromAPI() {
            let response = fetch('./contact.json').then(res => res.json())
.then(data => {
    let objectData = data.data
    for (let i = 0; i < objectData.length; i++) {
            let branch = objectData[i].branch // ดึงข้อมูลจาก object
            let address = objectData[i].address
            let map = objectData[i].map
            let tel = objectData[i].tel
            let Table = document.getElementById('tab')
            let tr = document.createElement('tr')
            Table.appendChild(tr)

            let td1 = document.createElement('td')
            td1.innerHTML = branch
            let td2 = document.createElement('td')
            td2.innerHTML = address
            let td3 = document.createElement('td')
            td3.innerHTML = map
            let td4 = document.createElement('td')
            td4.innerHTML = tel

            tr.appendChild(td1)
            tr.appendChild(td2)
            tr.appendChild(td3)
            tr.appendChild(td4)
            }
})
            // let rawData = await response.text() 
            // objectData = JSON.parse(rawData) // แปลผลลัพธ์เป็น object
            
            // let result = document.getElementById('result') // ดึง <ul> เพื่อใช้ในการเพิ่มแท็ก <li>มาจัดรูปแบบ

            // for (let i = 0; i < objectData.data.length; i++) {
            // let branch = objectData.data[i].branch // ดึงข้อมูลจาก object
            // let address = objectData.data[i].address
            // let map = objectData.data[i].map
            // let tel = objectData.data[i].tel

            // let Table = document.getElementById('tab')
            // let tr = document.createElement('tr')
            // Table.appendChild('tr')

            // let td1 = document.createElement('td')
            // td1.innerHTML = branch
            // let td2 = document.createElement('td')
            // td2.innerHTML = address
            // let td3 = document.createElement('td')
            // td3.innerHTML = map
            // let td4 = document.createElement('td')
            // td4.innerHTML = tel

            // tr.appendChild(td1)
            // tr.appendChild(td2)
            // tr.appendChild(td3)
            // tr.appendChild(td4)
            // }
            }
            getDataFromAPI()
        </script>
    </head>
    <body>
            สาขาทั้งหมด
            <table border="1" id="tab">
                <tr id="trr">
                    <th>สาขา</th>
                    <th>ที่อยู่</th>
                    <th>แผนที่</th>
                    <th>เบอร์ติดต่อ</th>
                </tr>
            </table>
    </body>
</html>