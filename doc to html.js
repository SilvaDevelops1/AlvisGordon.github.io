const mammoth = require("mammoth");
const fs = require("fs");

mammoth.convertToHtml({path: "resume.docx"})
    .then(result => {
        const html = result.value;
        fs.writeFileSync("resume.html", html);
    })
    .catch(err => {
        console.log(err);
    });