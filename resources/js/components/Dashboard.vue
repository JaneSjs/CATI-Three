<script lang="ts" setup>
import { Model } from "survey-core";
import { VisualizationPanel } from "survey-analytics";
import { onMounted } from "vue";

import "survey-analytics/survey.analytics.min.css";

const props = defineProps<{
    survey: any;
    results: any;
}>();

console.log(props.survey);
const survey = new Model(props.survey);
const results = props.results;


onMounted(() => {
    // console.log(survey.getAllQuestions());
    console.log(props.results);
    const dashboard = new VisualizationPanel(
        survey.getAllQuestions(),
        results,
    );
    dashboard.render(
        document.getElementById("summaryContainer") as HTMLElement
    );
});
</script>


<template>
    <div id="summaryContainer"></div>
</template>
