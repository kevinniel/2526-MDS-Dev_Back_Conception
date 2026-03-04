namespace LandaisSamuel_TP_DesignPatterns.Mediator;

// Contrat du médiateur
// On implémente une interface pour réduire la dépendance
public interface IWarehouseMediator
{
    void Notify(object sender, string warehouseEvent);
    // Ici warehouseEvent est un string pour simplifier,
    // mais dans une vraie application on pourrait utiliser un enum ou une classe dédiée
}

// Les différentes classes : ils connaissent uniquement le médiateur
public class StockManager(IWarehouseMediator mediator)
{
    // le médiateur est passé en paramètre (⬆️) du constructeur principal de la classe pour la DI

    private readonly IWarehouseMediator _mediator = mediator;

    // Ici la méthode simule une entrée de stock
    public void RegisterReception(string item, int quantity)
    {
        ConsoleHelper.WriteStep($"[StockManager] Stock mis à jour : +{quantity} x {item}");
        _mediator.Notify(this, "StockUpdated"); // Le médiateur est notifié
    }
}

public class ReceiptPrinter(IWarehouseMediator mediator)
{
    private readonly IWarehouseMediator _mediator = mediator;

    // Ici la méthode simule une impression de bon de réception
    public void PrintReceipt()
    {
        ConsoleHelper.WriteStep("[ReceiptPrinter] Bon de réception généré.");
    }
}

public class WarehouseNotifier(IWarehouseMediator mediator)
{
    private readonly IWarehouseMediator _mediator = mediator;

    // Ici la méthode simule une notification au responsable de l'entrepôt
    // (ils aiment bien suivre le travail de leurs équipes)
    public void AlertSupervisor()
    {
        ConsoleHelper.WriteStep("[WarehouseNotifier] Responsable notifié de la réception.");
    }
}

// Le médiateur : seul endroit qui connaît toutes les classes
public class ReceptionMediator : IWarehouseMediator
{
    public StockManager? StockManager { get; set; }
    public ReceiptPrinter? ReceiptPrinter { get; set; }
    public WarehouseNotifier? Notifier { get; set; }

    // Notify permet de capter un événement et déclencher des actions en fonction de celui-ci
    public void Notify(object sender, string warehouseEvent)
    {
        // On compare un string pour simplifier, voir explication dans l'interface
        if (warehouseEvent == "StockUpdated")
        {
            ReceiptPrinter?.PrintReceipt();
            Notifier?.AlertSupervisor();
        }
    }
}

public class MediatorDemo : IDemo
{
    // Méthode d'exemple pour montrer le fonctionnement du médiateur
    public void Run()
    {
        var mediator = new ReceptionMediator();

        var stock = new StockManager(mediator);
        var printer = new ReceiptPrinter(mediator);
        var notifier = new WarehouseNotifier(mediator);

        mediator.StockManager = stock;
        mediator.ReceiptPrinter = printer;
        mediator.Notifier = notifier;

        stock.RegisterReception("Palette de vis M6", 200);
    }
}
