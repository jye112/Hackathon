$resourceGroupName = "DevOpsSprint";
$attendeePrincipalId = "사용자ID";
$eventTag = "AKSDevOps";

az deployment sub create --location koreacentral --template-file "template.json" --parameters resourceGroupBaseName=$resourceGroupName eventTag=$eventTag attendeePrincipalId=$attendeePrincipalId;                                              
                                         