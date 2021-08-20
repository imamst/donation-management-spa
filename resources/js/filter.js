import Vue from "vue";
import helper from "./helper"

Vue.filter("formatRupiah", value => {
    return helper.formatRupiah(value);
});

Vue.filter("indonesianMonth", numeric_month => {
    return helper.convertToIndonesianMonth(numeric_month);
});