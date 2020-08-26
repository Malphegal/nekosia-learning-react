export default class Utils{
    
    // ---- METHODS ----

    static proceduralThemeColor(id)
    {
        let minAllowed = 4;
        let maxAllowed = 15;
        
        let r = decToHex(Math.floor(scaleBetween(((id + 1) * 8) % 16, minAllowed, maxAllowed, 0, 15)));
        let g = decToHex(Math.floor(scaleBetween(((id + 1) * 5) % 16, minAllowed, maxAllowed, 0, 15)));
        let b = decToHex(Math.floor(scaleBetween(((id + 1) * 11) % 16, minAllowed, maxAllowed, 0, 15)));
        
        return `#${r}${g}${b}FF`;
        
        function decToHex(value){
            switch (value) {
                case 10:
                    return 'AA';
                case 11:
                    return 'BB';
                case 12:
                    return 'CC';
                case 13:
                    return 'DD';
                case 14:
                    return 'EE';
                case 15:
                    return 'FF';
                default:
                    return `${value}${value}`;
            }
        };

        function scaleBetween(unscaledNum, minAllowed, maxAllowed, oldMin, oldMax){
            return (maxAllowed - minAllowed) * (unscaledNum - oldMin) / (oldMax - oldMin) + minAllowed;
        };
    };

    static difficultyColor(value)
    {
        switch (value) {
            case 1:
                return '#2E7F18';
            case 2:
                return '#45731E';
            case 3:
                return '#675E24';
            case 4:
                return '#8D472B';
            case 5:
                return '#B13433';
            default:
                return undefined;
        }
    }

    static formatDate(date)
    {
        return ("0" + date.getDate()).slice(-2) + "/" + ("0" + date.getMonth()).slice(-2) + "/" + (date.getYear() + 1900);
    }
}
