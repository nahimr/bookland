import { Controller } from 'stimulus';
import $ from "jquery";

export default class extends Controller {
    connect()
    {
        $('#auteur_date_de_naissance').datepicker({
            format: 'yyyy-mm-dd',
        })
    }
}