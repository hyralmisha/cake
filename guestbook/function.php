<?php

class FunctionInfo 

{
    
    /**
    * Check if the provided user is authorized for the request.
    *
    * Uses the configured Authorization adapters to check whether or not a user is authorized.
    * Each adapter will be checked in sequence, if any of them return true, then the user will
    * be authorized for the request.
    *
    * @param array $user The user to check the authorization of. If empty the user in the session will be used.
    * @param CakeRequest $request The request to authenticate for. If empty, the current request will be used.
    * @return boolean True if $user is authorized, otherwise false
    * 
    * Проверьте, если предоставленный пользователь авторизован для запроса.
    *
    * Использование настроенного адаптеры авторизации и проверить, 
    * действительно ли пользователь авторизован.
    * Каждый адаптер будет проверена в последовательности, если любой из них 
    * вернуться правда, то пользователю будет
    * Быть разрешено для запроса.
    *
    * @ Параметр массив $ пользователь пользователю проверить разрешения. 
    * Если пусто пользователя в сессии будет использоваться.
    * @ Параметр CakeRequest $ запроса Запрос для аутентификации для. 
    * Если пусто, текущий запрос будет использоваться.
    * @ Возвращает логическое значение Истина, если $ пользователь авторизован, иначе ложной
     * 
     */
     public function isAuthorized($user = null, CakeRequest $request = null) {
         if (empty($user) && !$this->user()) {
             return false;
         }
         if (empty($user)) {
             $user = $this->user();
         }
         if (empty($request)) {
             $request = $this->request;
         }
         if (empty($this->_authorizeObjects)) {
             $this->constructAuthorize();
         }
         foreach ($this->_authorizeObjects as $authorizer) {
             if ($authorizer->authorize($user, $request) === true) {
                 return true;
             }
         }
         return false;
     }

}
?>
