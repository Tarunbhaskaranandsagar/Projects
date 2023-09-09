const convertBtn = document.getElementById("convertBtn");
convertBtn.addEventListener("click", convertTemperature);

function convertTemperature() {
    const inputTemp = parseFloat(document.getElementById("inputTemp").value);
    const fromScale = document.getElementById("fromScale").value;
    const toScale = document.getElementById("toScale").value;
    
    // Perform temperature conversion logic here
    
    const result = calculateConversion(inputTemp, fromScale, toScale);
    
    document.getElementById("result").innerText = `${inputTemp} ${fromScale} is ${result.toFixed(2)} ${toScale}`;
}

function calculateConversion(temp, from, to) {
    if (from === "celsius" && to === "fahrenheit") {
        return (temp * 9/5) + 32;
    } else if (from === "fahrenheit" && to === "celsius") {
        return (temp - 32) * 5/9;
    } else if (from === "celsius" && to === "kelvin") {
        return temp + 273.15;
    } else if (from === "kelvin" && to === "celsius") {
        return temp - 273.15;
    } else if (from === "fahrenheit" && to === "kelvin") {
        return (temp - 32) * 5/9 + 273.15;
    } else if (from === "kelvin" && to === "fahrenheit") {
        return (temp - 273.15) * 9/5 + 32;
    } else {
        return temp; // If fromScale and toScale are the same
    }
}
