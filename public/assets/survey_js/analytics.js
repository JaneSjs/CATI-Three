document.addEventListener("DOMContentLoaded", async function () {
  
  const SchemaUrl = document.getElementById("survey_url").innerHTML;
  const ResultsUrl = document.getElementById("result_url").innerHTML;
  const survey_id  = document.getElementById("survey_id").textContent;

  Promise.all([fetch(SchemaUrl), fetch(ResultsUrl)])
    .then(responses => Promise.all(responses.map(response => response.json())))
    .then(([surveySchema, surveyResults]) => {

      console.log('Survey Schema: ', surveySchema);
      console.log('Survey Results: ', surveyResults);

      let parsedSchema, parsedResults;
      try {
        parsedSchema = JSON.parse(surveySchema.content);
        parsedResults = JSON.parse(surveyResults.content);
        console.log('Parsed Survey Schema:', parsedSchema);
        console.log('Parsed Survey Results:', parsedResults);
      } catch (error) {
        console.error('Error parsing JSON:', error);
        throw error;
      }

      const survey = new Survey.Model(parsedSchema);

      const vizPanelOptions = {
        allowHideQuestions: false
      };

      const vizPanel = new SurveyAnalytics.VisualizationPanel(
        parsedSchema,
        parsedResults,
        vizPanelOptions
      );

      vizPanel.render("surveyVizPanel");
    })
    .catch(error => {
      console.error("Error fetching data:", error);
    });
});
