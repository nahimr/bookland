import { Controller } from '@hotwired/stimulus';
import $ from "jquery";

export default class extends Controller
{
    connect() 
    {
        
    }

    filter()
    {
        $('.filter-auteur').collapse('show');
    }
}