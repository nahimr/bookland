import { Controller } from '@hotwired/stimulus';
import $ from "jquery";

export default class extends Controller
{
    connect()
    {
        $('#livre_filter_fromDate').datepicker({
            format: 'yyyy-mm-dd',
        });
        $('#livre_filter_toDate').datepicker({
            format: 'yyyy-mm-dd',
        })
        $('#livre_date_de_parution').datepicker({
            format: 'yyyy-mm-dd',
        })
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

    filter()
    {
        $('.collapseOne').collapse('show');
    }
}