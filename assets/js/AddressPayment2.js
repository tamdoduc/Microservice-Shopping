var citis = document.getElementById("city");
var district = document.getElementById("district");
var ward = document.getElementById("ward");
var Parameter = {
  url: "./data.json", //Đường dẫn đến file chứa dữ liệu hoặc api do backend cung cấp
  method: "GET", //do backend cung cấp
  responseType: "application/json", //kiểu Dữ liệu trả về do backend cung cấp
};
//gọi ajax = axios => nó trả về cho chúng ta là một promise
var promise = axios(Parameter);
//Xử lý khi request thành công
promise.then(function (result) {
  renderCity(result.data);
});

function renderCity(data) {
  for (const x of data) {
    citis.options[citis.options.length] = new Option(x.Name, x.Id);
    if (parseInt(x.Id) == hiddenCity.value)
    {
      citis.selectedIndex = x.Id;
      district.length = 1;
      ward.length = 1;
      if (this.value != "") {
        const result = data.filter(n => n.Id === citis.value);
        for (const k of result[0].Districts) {
          district.options[district.options.length] = new Option(k.Name, k.Id);
          if (parseInt(k.Id) == hiddenDistrict.value)
          {
            district.selectedIndex = district.options.length-1;
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
              const dataWards = dataCity[0].Districts.filter(n => n.Id === district.value)[0].Wards;
        
              for (const w of dataWards) {
                ward.options[ward.options.length] = new Option(w.Name, w.Id);
                if (parseInt(w.Id) == hiddenWard.value)
                {
                    ward.selectedIndex = ward.options.length-1;
                }
              }
            }
          }
        }
      }
    }
  }

  // xứ lý khi thay đổi tỉnh thành thì sẽ hiển thị ra quận huyện thuộc tỉnh thành đó
  citis.onchange = function () {
    district.length = 1;
    ward.length = 1;
    if (this.value != "") {
      const result = data.filter(n => n.Id === this.value);

      for (const k of result[0].Districts) {
        district.options[district.options.length] = new Option(k.Name, k.Id);
      }
    }
  };

  // xứ lý khi thay đổi quận huyện thì sẽ hiển thị ra phường xã thuộc quận huyện đó
  district.onchange = function () {
    ward.length = 1;
    const dataCity = data.filter((n) => n.Id === citis.value);
    if (this.value != "") {
      const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

      for (const w of dataWards) {
        ward.options[wards.options.length] = new Option(w.Name, w.Id);
      }
    }
  };
}