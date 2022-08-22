@props([
    'orgname' => '[Insert Org Name Here]',
])

<style>
    #covidadvisory td{text-align: justify; padding: 0.5rem; border: 0px solid white;}
</style>
<table id="covidadvisory" class="" style="margin-top: 1rem; border: 1px solid darkgray;">
    <tr style="background-color: rgba(0,0,0, 0.1);">
        <th style="text-align: center; padding: .5rem; font-weight: bold;">
            COVID-19 ADVISORY
        </th>
    </tr>
    <tr>
        <td>
            By registering for/attending this event, I acknowledge that I fully understand the nature and extent of the
            risks presented by COVID-19 due to my in-person attendance at this event, including the risk that COVID-19 may
            lead to severe illness or death. I also understand and acknowledge that there are risks of exposure to COVID-19,
            whether resulting from travel through high-risk areas, the failure of other individuals to follow proper COVID-19
            protocols, such as maintaining proper social distancing and proper hygiene measures, and other such risks.
            While I understand that CJMEA has taken reasonable steps to address the risks presented by COVID-19, I recognize
            that the COVID-19 protocols being utilized at the event may be insufficient to prevent my contracting COVID-19
            and suffering any related injuries, and that I expressly nevertheless assume all of these risks.
        </td>
    </tr>
    <tr>
        <td>
            With full knowledge of the risks involved, therefore, I hereby release, waive, and discharge {{ $orgname }}, its officers,
            directors, employees, contractors, and agents, from any and all liability, loss, damage, claims, demands, actions,
            and causes of action whatsoever, including reasonable attorneys' fees, directly or indirectly arising out of
            or related to any loss, damage, injury, or death, that may be sustained by me while participating in this event
            or while in, on, or around the event premises that may lead to exposure or harm due to COVID-19.
        </td>
    </tr>
</table>
