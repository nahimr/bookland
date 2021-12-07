import { Controller } from '@hotwired/stimulus';
import $ from "jquery";

export default class extends Controller
{
    connect()
    {
        $('#filter_elements').hide();
        $('#livre_filter_fromDate').datepicker({
            format: 'yyyy-mm-dd',
        });
        $('#livre_filter_toDate').datepicker({
            format: 'yyyy-mm-dd',
        });
    }

    toggle() // Method called by clicking on filter
    {
        let filterElements = $('#filter_elements');

        filterElements.is(":hidden") ? filterElements.show() : filterElements.hide();
    }

    noteHandler()
    {
        let noteMax = $('#livre_filter_toScore');
        let noteMin = $('#livre_filter_fromScore');
        if (parseInt(noteMin.val()) > parseInt(noteMax.val()))
        {
            noteMax.val(noteMin.val());
        }
    }

    dateHandler()
    {
        // let dateMin = $('#livre_filter_fromDate');
        // let dateMax = $('#livre_filter_toDate');
        //
        // if (Date.parse(dateMin.val()) > Date.parse(dateMax.val()))
        // {
        //     console.log("setDate");
        //     dateMax.datepicker("setDate", new Date(Date.parse(dateMin)));
        // }
    }
}