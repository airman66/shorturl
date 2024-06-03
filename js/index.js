async function sendData(data) {
    const url = '/api/generate.php';

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        return await response.json();
    } catch (error) {
        console.error('Error:', error);
    }
}

const form = document.querySelector("#url-form");
form.addEventListener("submit", async e => {
    e.preventDefault();
    const value = form.querySelector("input").value;
    if (value.trim()) {
        await sendData({redirectTo: value.trim()}).then(r => {
            if(r.code == 200) {
                const linkBlock = document.querySelector("#link-block");
                linkBlock.classList.remove("hidden");
                linkBlock.querySelector(".link-block__content-url").innerHTML = location.origin+r.url;
                document.querySelector("#forCopy").value = location.origin+r.url;
            }
        });
    }
});

const copyBtn = document.querySelector("#copyBtn");
copyBtn.addEventListener("click", async () => {
    const copyText = document.querySelector("#forCopy").value;
    try {
        await navigator.clipboard.writeText(copyText);
        alert('Ссылка скопирована');
    } catch (err) {
        console.error('Failed to copy text: ', err);
    }
});