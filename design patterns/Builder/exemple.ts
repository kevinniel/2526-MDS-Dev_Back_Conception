// Classe produit : l'ordinateur à construire
class Computer {
    private cpu: string;
    private gpu: string | null;
    private ram: number;
    private storage: string;
    private case: string;
    private cooling: string | null;
    private powerSupply: string | null;

    constructor(
        cpu: string,
        ram: number,
        storage: string,
        caseType: string,
        gpu?: string,
        cooling?: string,
        powerSupply?: string
    ) {
        this.cpu = cpu;
        this.ram = ram;
        this.storage = storage;
        this.case = caseType;
        this.gpu = gpu || null;
        this.cooling = cooling || null;
        this.powerSupply = powerSupply || null;
    }

    public getSpecs(): string {
        let specs = `CPU: ${this.cpu}\n`;
        specs += `RAM: ${this.ram}GB\n`;
        specs += `Stockage: ${this.storage}\n`;
        specs += `Boîtier: ${this.case}\n`;
        
        if (this.gpu) {
            specs += `Carte graphique: ${this.gpu}\n`;
        }
        
        if (this.cooling) {
            specs += `Refroidissement: ${this.cooling}\n`;
        }
        
        if (this.powerSupply) {
            specs += `Alimentation: ${this.powerSupply}\n`;
        }
        
        return specs;
    }
}

// Classe Builder : gère la construction étape par étape
class ComputerBuilder {
    private cpu: string | null = null;
    private gpu: string | null = null;
    private ram: number | null = null;
    private storage: string | null = null;
    private case: string | null = null;
    private cooling: string | null = null;
    private powerSupply: string | null = null;

    // Méthodes de configuration (fluent interface)
    public withCPU(cpu: string): ComputerBuilder {
        this.cpu = cpu;
        return this;
    }

    public withGPU(gpu: string): ComputerBuilder {
        this.gpu = gpu;
        return this;
    }

    public withRAM(ram: number): ComputerBuilder {
        this.ram = ram;
        return this;
    }

    public withStorage(storage: string): ComputerBuilder {
        this.storage = storage;
        return this;
    }

    public withCase(caseType: string): ComputerBuilder {
        this.case = caseType;
        return this;
    }

    public withCooling(cooling: string): ComputerBuilder {
        this.cooling = cooling;
        return this;
    }

    public withPowerSupply(powerSupply: string): ComputerBuilder {
        this.powerSupply = powerSupply;
        return this;
    }

    // Méthode de construction finale avec validation
    public build(): Computer {
        // Validation des composants obligatoires
        if (!this.cpu) {
            throw new Error("CPU est obligatoire pour construire un ordinateur");
        }
        if (!this.ram) {
            throw new Error("RAM est obligatoire pour construire un ordinateur");
        }
        if (!this.storage) {
            throw new Error("Stockage est obligatoire pour construire un ordinateur");
        }
        if (!this.case) {
            throw new Error("Boîtier est obligatoire pour construire un ordinateur");
        }

        return new Computer(
            this.cpu,
            this.ram,
            this.storage,
            this.case,
            this.gpu || undefined,
            this.cooling || undefined,
            this.powerSupply || undefined
        );
    }
}

// Exemple d'utilisation
console.log("---- Configurateur d'ordinateur sur mesure ----\n");

// Configuration d'un ordinateur de bureau standard
const builder1 = new ComputerBuilder();
const desktop = builder1
    .withCPU("Intel Core i5-12400")
    .withRAM(16)
    .withStorage("512GB SSD")
    .withCase("ATX Mid Tower")
    .build();

console.log("=== Ordinateur de bureau standard ===");
console.log(desktop.getSpecs());
console.log();

// Configuration d'un ordinateur gaming avec tous les composants
const builder2 = new ComputerBuilder();
const gamingPC = builder2
    .withCPU("AMD Ryzen 7 5800X")
    .withGPU("NVIDIA RTX 4070")
    .withRAM(32)
    .withStorage("1TB NVMe SSD")
    .withCase("ATX Full Tower")
    .withCooling("Watercooling AIO 240mm")
    .withPowerSupply("850W 80+ Gold")
    .build();

console.log("=== Ordinateur gaming complet ===");
console.log(gamingPC.getSpecs());
console.log();

// Configuration d'un ordinateur compact (sans GPU dédiée)
const builder3 = new ComputerBuilder();
const compactPC = builder3
    .withCPU("AMD Ryzen 5 5600G")
    .withRAM(16)
    .withStorage("256GB SSD")
    .withCase("Mini ITX")
    .withPowerSupply("450W 80+ Bronze")
    .build();

console.log("=== Ordinateur compact ===");
console.log(compactPC.getSpecs());
console.log();

// Avantage : on peut réutiliser le builder pour créer plusieurs configurations
const builder4 = new ComputerBuilder();
builder4.withCPU("Intel Core i7-13700K").withRAM(32).withStorage("2TB SSD");

const workstation1 = builder4.withCase("ATX Mid Tower").withGPU("NVIDIA RTX 4060").build();
console.log("=== Station de travail 1 ===");
console.log(workstation1.getSpecs());
console.log();

// Réinitialisation et nouvelle configuration avec les mêmes composants de base
const builder5 = new ComputerBuilder();
const workstation2 = builder5
    .withCPU("Intel Core i7-13700K")
    .withRAM(32)
    .withStorage("2TB SSD")
    .withCase("ATX Full Tower")
    .withGPU("NVIDIA RTX 4090")
    .withCooling("Watercooling AIO 360mm")
    .build();

console.log("=== Station de travail 2 (haute performance) ===");
console.log(workstation2.getSpecs());
