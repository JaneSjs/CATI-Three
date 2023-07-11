document.addEventListener("DOMContentLoaded", function () {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  const patch_url = document.getElementById("patch_url").textContent;
  const results_url = document.getElementById("results_url").textContent;
  const schema_url = document.getElementById("schema_url").textContent;
  const survey_id = document.getElementById("survey_id").textContent;
  const user = document.getElementById("user").textContent;

  if (csrf && patch_url && results_url && survey_id && user) {
    console.log('CSRF', csrf);
    console.log("PATCH Url: " + patch_url);
    console.log("Survey Results Url: " + results_url);
    console.log("Schema Url: " + schema_url);
    console.log("Survey ID: " + survey_id);
    console.log("User: " + user);

    function fetchSchema() {
      return fetch(schema_url)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else {
            throw new Error("Error fetching survey results");
          }
        }).then((data) => {
          if (data && data.survey) {
            return data.survey;
          } else {
            throw new Error('Invalid Survey Schema Format');
          }
        });
    }

    fetchSchema()
      .then((Schema) => {
        console.log("Schema", Schema);
        renderSurveyCreator(Schema);
      })
      .catch((error) => {
        console.error("Error fetching Schema:", error);
      });

    function renderSurveyCreator(Schema) {
      console.log(Schema);
      const creatorOptions = {
        showLogicTab: true,
        isAutoSave: false,
      };

      const creator = new SurveyCreator.SurveyCreator(creatorOptions);

      const parsedSchema = JSON.parse(Schema.content);

      // Populate the survey creator with survey Schema
      creator.text = JSON.stringify(parsedSchema);

      creator.render("surveyCreator");

      creator.saveSurveyFunc = (saveNo, callback) => {
        // If you use a web service:
        saveSurveyJson(patch_url, creator.JSON, saveNo, callback);
      };
    }

    function saveSurveyJson(patch_url, json, saveNo, callback) {
      const data = {
        user: user,
        id: survey_id,
        content: json,
        version: saveNo,
      };

      const options = {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json; charset=UTF-8",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrf,
        },
        credentials: "same-origin",
      };

      console.log(data);

      fetch(patch_url, options)
        .then((response) => {
          if (response.ok) {
            // Parse the response only if it's JSON
            return response.json();
          } else {
            throw new Error("Server or Network Error.");
          }
        })
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
    }
  }
});
